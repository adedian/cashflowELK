/* Dimuat sinkron SEBELUM overlay intro (CSP: script-src 'self' => tanpa script inline).
   Menandai JS aktif (timeline ditahan sampai logo siap) dan memasang watchdog agar intro tetap mulai
   walau decode gambar atau login.js bermasalah. Intro diputar setiap halaman login dibuka/di-refresh. */
(function () {
  'use strict';
  document.documentElement.classList.add('js');
  window.__elkIntroWatchdog = setTimeout(function () {
    var i = document.getElementById('intro');
    if (i) i.classList.add('go');
  }, 1600);
})();
