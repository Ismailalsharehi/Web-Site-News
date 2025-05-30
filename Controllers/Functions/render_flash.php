 <?php

  use Core\Session;
  use Core\Flash;



  function render_flash()
  {
    $html = '';

    $success = Flash::get('success');
    if ($success) {
      $html .= '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          ' . htmlspecialchars($success) . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    $error = Flash::get('error');
    if ($error) {
      $html .= '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          ' . htmlspecialchars($error) . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    $warning = Flash::get('warning');
    if ($warning) {
      $html .= '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          ' . htmlspecialchars($warning) . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    return $html;
  }
