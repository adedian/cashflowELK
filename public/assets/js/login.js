(function () {
  'use strict';
  var pw = document.getElementById('password');
  var user = document.getElementById('username');
  var tg = document.getElementById('togglePw');
  var form = document.getElementById('loginForm');
  var btn = document.getElementById('loginBtn');
  var alertBox = document.getElementById('lgAlert');
  var alertText = document.getElementById('lgAlertText');
  var page = document.querySelector('.login-card');
  var btnHtml = btn ? btn.innerHTML : '';

  /* ---------- Opening animation: JS hanya mengatur kapan mulai, skip, dan pembersihan ---------- */
  var intro = document.getElementById('intro');
  if (intro) {
    var played = false;
    var start = function () {
      if (played) return;
      played = true;
      clearTimeout(window.__elkIntroWatchdog);
      intro.classList.add('go');
    };
    var remove = function () { if (intro && intro.parentNode) { intro.parentNode.removeChild(intro); } };
    var skip = function () {
      if (page) page.classList.add('skip');
      intro.classList.add('leave');
      setTimeout(remove, 450);
    };

    // mulai setelah logo ter-decode agar timeline tidak berjalan dengan gambar yang belum siap (watchdog di login.php menjamin tetap mulai)
    var img = intro.querySelector('.intro-logo img');
    if (img && img.decode) { img.decode().then(start, start); } else { start(); }

    intro.addEventListener('animationend', function (ev) {
      if (ev.target === intro && (ev.animationName === 'introOut' || ev.animationName === 'introLeave')) remove();
    });
    var skipBtn = document.getElementById('introSkip');
    if (skipBtn) skipBtn.addEventListener('click', skip);
    document.addEventListener('keydown', function (ev) { if (ev.key === 'Escape' && document.getElementById('intro')) skip(); });
  }

  /* ---------- Form login ---------- */
  var showError = function (msg, field) {
    if (!alertBox) return;
    alertText.textContent = msg;
    alertBox.hidden = false;
    alertBox.classList.remove('shake');
    void alertBox.offsetWidth;          // restart animasi getar halus
    alertBox.classList.add('shake');
    [user, pw].forEach(function (el) { if (el) el.removeAttribute('aria-invalid'); });
    if (field) { field.setAttribute('aria-invalid', 'true'); field.focus(); }
  };
  var clearInvalid = function (ev) { ev.target.removeAttribute('aria-invalid'); };
  if (user) user.addEventListener('input', clearInvalid);
  if (pw) pw.addEventListener('input', clearInvalid);

  if (tg && pw) {
    tg.addEventListener('click', function () {
      var show = pw.type === 'password';
      pw.type = show ? 'text' : 'password';
      tg.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
      tg.querySelector('use').setAttribute('href', show ? '#i-eye-off' : '#i-eye');
      pw.focus();
    });
  }
  if (form && btn) {
    form.addEventListener('submit', function (ev) {
      if (!user.value.trim()) { ev.preventDefault(); showError('Username wajib diisi.', user); return; }
      if (!pw.value) { ev.preventDefault(); showError('Password wajib diisi.', pw); return; }
      btn.classList.add('loading');
      btn.setAttribute('disabled', 'disabled');
      btn.setAttribute('aria-busy', 'true');
      btn.innerHTML = '<span class="spin"></span><span class="lbl">Memproses…</span>';
    });
  }
  // tombol Back/Forward memulihkan halaman dari cache dengan tombol masih "memproses": kembalikan ke keadaan siap
  window.addEventListener('pageshow', function (ev) {
    if (ev.persisted && btn) {
      btn.classList.remove('loading');
      btn.removeAttribute('disabled');
      btn.removeAttribute('aria-busy');
      btn.innerHTML = btnHtml;
    }
  });
  // setelah salah password server mengirim ulang halaman: fokus ke password agar bisa langsung mengetik ulang
  if (alertBox && !alertBox.hidden && pw && user && user.value) { pw.focus(); }
})();
