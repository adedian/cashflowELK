<?php
// Animasi pembuka dimainkan setiap halaman login dibuka atau di-refresh, tetapi tidak setelah salah password
// (agar pengguna bisa langsung mengetik ulang). Tanpa JavaScript, timeline CSS tetap berjalan sendiri dan menutup dirinya.
$intro = empty($error);
$mark  = e(asset('images/logo-elk-mark.png'));
?>
<?php if ($intro): ?>
<script src="<?= e(asset('js/intro-boot.js')) ?>"></script>
<div class="intro" id="intro" role="presentation">
  <div class="intro-glow"></div>
  <div class="intro-stage">
    <div class="intro-logo">
      <img src="<?= $mark ?>" alt="" width="640" height="515" decoding="async">
      <span class="intro-sheen" style="--mark:url('<?= $mark ?>')"></span>
    </div>
    <div class="intro-word"><span>CASHFLOW</span><b>ELK</b></div>
    <div class="intro-line"></div>
    <div class="intro-tag">Pengelolaan Arus Kas</div>
  </div>
  <button type="button" class="intro-skip" id="introSkip" aria-label="Lewati animasi pembuka">Lewati</button>
</div>
<?php endif; ?>
<section class="login-card<?= $intro ? ' has-intro' : '' ?>">
  <div class="login-left">
    <div class="brand"><img src="<?= e(asset('images/logo-elk.png')) ?>" alt="Logo ELK"><span class="brand-name"><strong>Cashflow <em>ELK</em></strong><small>ELK</small></span></div>
    <div class="illus" aria-hidden="true">
      <svg viewBox="0 0 320 260" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="160" cy="236" rx="120" ry="14" fill="rgba(255,255,255,.14)"/>
        <rect x="70" y="30" width="150" height="196" rx="14" fill="#fff" opacity=".96"/>
        <rect x="118" y="18" width="54" height="26" rx="8" fill="#ff7b80"/>
        <rect x="132" y="12" width="26" height="14" rx="5" fill="#a50f16"/>
        <rect x="90" y="64" width="110" height="10" rx="5" fill="#f8cfd1"/>
        <path d="M92 104l7 7 13-14" stroke="#d71920" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="124" y="98" width="76" height="10" rx="5" fill="#f8cfd1"/>
        <path d="M92 142l7 7 13-14" stroke="#d71920" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="124" y="136" width="60" height="10" rx="5" fill="#f8cfd1"/>
        <rect x="92" y="176" width="14" height="30" rx="3" fill="#f1a1a5"/>
        <rect x="114" y="164" width="14" height="42" rx="3" fill="#d71920"/>
        <rect x="136" y="150" width="14" height="56" rx="3" fill="#6e0a12"/>
        <rect x="158" y="170" width="14" height="36" rx="3" fill="#ff8a8e"/>
        <circle cx="246" cy="86" r="30" fill="#ffb300"/>
        <text x="246" y="96" text-anchor="middle" font-family="Segoe UI,Arial" font-size="28" font-weight="700" fill="#fff">Rp</text>
        <circle cx="262" cy="170" r="16" fill="rgba(255,255,255,.35)"/>
        <circle cx="48" cy="120" r="10" fill="rgba(255,255,255,.35)"/>
      </svg>
    </div>
    <h2>Selamat datang</h2>
    <p>Pantau arus kas, rekening, limit pinjaman, dan piutang proyek ELK dalam satu tempat.</p>
  </div>

  <div class="login-right">
    <h1>Masuk</h1>
    <p class="sub">Gunakan akun yang diberikan administrator. Pendaftaran mandiri tidak tersedia.</p>

    <div class="alert alert-danger mb-2" id="lgAlert" role="alert" aria-live="assertive"<?= empty($error) ? ' hidden' : '' ?>><span id="lgAlertText"><?= e($error ?? '') ?></span></div>

    <form method="post" action="<?= e(url('/login')) ?>" id="loginForm" autocomplete="on" novalidate>
      <?= csrf_field() ?>
      <div class="uline">
        <input type="text" name="username" id="username" placeholder="Username" value="<?= e($username ?? '') ?>" autocomplete="username" maxlength="50" required autofocus aria-label="Username">
        <span class="ico"><svg class="i"><use href="#i-user"/></svg></span>
      </div>
      <div class="uline">
        <input type="password" name="password" id="password" placeholder="Password" autocomplete="current-password" maxlength="200" required aria-label="Password">
        <button class="ico" type="button" id="togglePw" aria-label="Tampilkan password"><svg class="i"><use href="#i-eye"/></svg></button>
      </div>
      <button class="btn" type="submit" id="loginBtn"><span class="lbl">Masuk</span></button>
    </form>

    <p class="login-note">Lupa password? Hubungi administrator (Super Admin) untuk mengatur ulang.</p>
  </div>
</section>
