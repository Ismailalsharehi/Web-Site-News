<?php

namespace Controllers\articles;

// if (headers_sent($file, $line)) {
//     die("Headers already sent in $file on line $line");
// }

var_dump("sdfgbhnj");

use Core\Session;

Session::start();

use Core\Database\Connection;
use Controllers\Functions\Functions;
use PDO;
use PDOException;

use Core\Flash;



// var_dump("sdfgbhnj");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$pdo = Connection::connect();
try {

  $stmt = $pdo->prepare("SELECT id, name FROM categories"); // بدون شرط id
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  Flash::set('error', '   فشل الاتصال الان');
  $e->getMessage();
  header("Location:/404");
  exit;
}



// var_dump($categories);


// التأكد من أن النموذج تم إرساله
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {


  $title        = htmlspecialchars($_POST['title']);
  $summary      = Functions::cleanInput($_POST['summary']);
  $content      = trim($_POST['content']);
  $category_id  = (int) $_POST['category_id'];
  $status       = in_array($_POST['status'], ['draft', 'published', 'archived']) ? $_POST['status'] : 'draft';
  $is_featured  = isset($_POST['is_featured']) ? 1 : 0;
  $video_url    = filter_var($_POST['video_url'], FILTER_SANITIZE_URL);
  $user_id      = (int) ($_POST['user_id'] ?? 1);

  $slug         = Functions::generateSlug($title);

  if (empty($title) || empty($summary) || empty($content) || empty($slug)) {

    Flash::set('error', 'يرجى ملئ الحقول المطلوبة');
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
  }


  // التأكد من أن الـ slug فريد
  try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE slug = ?");
    $stmt->execute([$slug]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {
      $slug .= '-' . time(); // إضافة رقم زمني لتمييز slug
    }
  } catch (PDOException $e) {
    Flash::set('error', 'حدث خطأ أثناء الاتصال بقاعدة البيانات: ' . $e->getMessage());
    header('Location:/404');
    exit;
  }


  // التعامل مع رفع الصورة

  // $image_path = null;

  // رفع الصورة
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {

    $file = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $size = $_FILES['photo']['size'];
    $type = $_FILES['photo']['type'];
    $error = $_FILES['photo']['error'];
    $fileExt = explode('.', $file);
    $fileActual = strtolower(end($fileExt));
    $allow = array('jpg', 'jpeg', 'png', 'pdf');
    if (in_array($fileActual, $allow)) {
      if ($error === 0) {
        if ($size < 10000000) {
          $filenamenew = uniqid('', true) . "." . $fileActual; // إنشاء اسم فريد للملف
          $fileDestination = __DIR__ . '/../../views/media/images/' . $filenamenew;

          echo $fileDestination;
          move_uploaded_file($tmp, $fileDestination);
          $image_path = $filenamenew;
        } else {
          Flash::set('error', '  حجم الملف كبير جداُ الحد المسموح به لا يجب أن يتجاوز 10 ميجا ');
          header("Location: " . $_SERVER["HTTP_REFERER"]);
          exit;
        }
      } else {
        Flash::set('error', '  فشل أثناء رفع الملف');
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
      }
    } else {
      // abort(400);
      Flash::set('error', '  نوع الملف غير مسموح ');
      header('Location: /article_create_view');
      exit;
    }
  } else {
    Flash::set('error', '  لم يتم رفع أي صورة');
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }



  // تحديد وقت النشر
  $published_at = ($status === 'published') ? date('Y-m-d H:i:s') : null;

  // إدخال البيانات في قاعدة البيانات

  try {
    $stmt = $pdo->prepare("INSERT INTO articles (
        user_id, category_id, title, slug, summary, content, image_path, video_url,
        status, is_featured, published_at
    ) VALUES (
        :user_id, :category_id, :title, :slug, :summary, :content, :image_path, :video_url,
        :status, :is_featured, :published_at
    )");

    $articles = $stmt->execute([
      ':user_id'       => $user_id,
      ':category_id'   => $category_id,
      ':title'         => $title,
      ':slug'          => $slug,
      ':summary'       => $summary,
      ':content'       => $content,
      ':image_path'    => $image_path,
      ':video_url'     => $video_url ?: null,
      ':status'        => $status,
      ':is_featured'   => $is_featured,
      ':published_at'  => $published_at
    ]);

    if ($articles) {
      Flash::set('error', ' تم نشر المقال بنجاح');
      header('Location: /article_show?slug=' . $slug);
      exit;
      // header("Location: articles_list.php");
      // exit;
    } else {
      Flash::set('error', '  حدث خطأ أثناء نشر المقال');
      header('Location: /article_create_view');
      exit;
    }
  } catch (PDOException $e) {
    Flash::set('error', 'حدث خطأ أثناء الاتصال بقاعدة البيانات: ' . $e->getMessage());
    header('Location:/404');
    exit;
  }
}



// require('View/pages/articles/create_view.php');
