<?php

use Core\Flash;
use Core\Session;

Session::destroy();
Flash::set('success', 'تم تسجيل خروجك بنجاح');
header("Location: /"); // رجّع المستخدم لصفحة تسجيل الدخول
exit;
