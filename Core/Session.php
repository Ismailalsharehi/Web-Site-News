<?php

namespace Core;


class Session
{


  public static function start(): void
  {
    if (session_status() === PHP_SESSION_NONE) { // تحقق إذا كانت الجلسة لم تبدأ بعد
      session_start();
    }
  }


  public static function set(string $key, mixed $value): void
  {


    self::start();
    $_SESSION[$key] = $value;
  }

  public static function get(string $key, mixed $defult = null): mixed
  {
    self::start();
    return $_SESSION[$key] ?? $defult;
  }

  public static function has(string $key): bool
  {
    self::start();
    return isset($_SESSION[$key]); // رجعه اذا موجود
  }


  public static function remove(string $key): void
  {
    self::start();
    unset($_SESSION[$key]);
  }

  public static function destroy(): void
  {
    self::start();
    session_unset();
    session_destroy();
    setcookie(
        'remember_me',
        '',
        [
            'expires' => time() - 3600, 
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]
    );
  }

  public static function all(): array
  {
    self::start();
    return $_SESSION;
  }


  public static function user(): ?array
  {
    return self::get('user');
  }

  public static function userRole(): ?string
  {
    return self::user()['role'] ?? null;
  }

  public static function isAdmin(): bool
  {
    return self::userRole() === 'admin';
  }

  // public static function hasRole(string $role): bool
  // {
  //   return self::userRole() === $role;
  // }

  public static function isLoggedIn(): bool
  {
    return self::has('user');
  }

}
