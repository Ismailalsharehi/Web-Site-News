<?php

use Core\Session;

Session::destroy();

header("Location: /"); // رجّع المستخدم لصفحة تسجيل الدخول
exit;
