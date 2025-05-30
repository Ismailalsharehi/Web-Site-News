
  setTimeout(function() {
    const flash = document.getElementById('flash-message');
    if (flash) {
      flash.style.transition = 'opacity 0.5s ease';
      flash.style.opacity = 0;
      setTimeout(() => flash.remove(), 500); 
    }
  }, 5000); 


$("#login").submit(function (e) {
    e.preventDefault(); // يمنع إعادة تحميل الصفحة

    $.ajax({
      url: "../pages/users/index_view.php",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        $("#loginMessage").html(response); // نعرض HTML مباشرة من السيرفر
        if (response.includes('alert-success')) {
          setTimeout(() => {
            window.location.href = "../pages/articles/index_view.php";
          }, 2000);
        }
      },
      error: function () {
        $("#loginMessage").html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            حدث خطأ أثناء إرسال البيانات.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `);
      }
    });
  });