

<?php
//دوال مهمه تستخدم ب كثره

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function urls($value)
{
    return $_SERVER["REQUEST_URI"] == $value;
}

function routeToControler($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        http_response_code(200);

        require $routes[$uri];
    } else {
        abort(404);
    }
}

function abort($code = 404)
{
    http_response_code($code);
    require "views/errors/{$code}.php";
    die();
}



function logIn($user)
{

    $_SESSION['user'] =  [
        'email' => $user['email'],
        'id' => $user['user_id'],
        'type' => $user['type'],
        'photo' => $user['photo']
    ];
    session_regenerate_id(true);
}



function logOut()
{
    $_SESSION = [];
    $user['email']  = null;
    $user['user'] = null;
    $user['role'] = null;
    session_destroy();

    $params =  session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}


function base_path($path)
{
    return __DIR__ . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}





// <?php

class SessionHelper {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    public static function flash($key, $message = null) {
        self::start();
        if ($message) {
            $_SESSION['flash'][$key] = $message;
        } else {
            if (!empty($_SESSION['flash'][$key])) {
                $msg = $_SESSION['flash'][$key];
                unset($_SESSION['flash'][$key]);
                return $msg;
            }
            return null;
        }
    }
}
