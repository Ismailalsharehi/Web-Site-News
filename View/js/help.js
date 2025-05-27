
  setTimeout(function() {
    const flash = document.getElementById('flash-message');
    if (flash) {
      flash.style.transition = 'opacity 0.5s ease';
      flash.style.opacity = 0;
      setTimeout(() => flash.remove(), 500); // بعد التلاشي، احذفه من DOM
    }
  }, 5000); // 5000   = 5 ثواني
