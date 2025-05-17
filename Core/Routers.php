<?php

// namespace Core\Middleware;



// class Route
// {
//   private static array $routes = [];
//   private static array $compiledRoutes = [];

//   public static function get(string $uri, string $action): RouteDefinition
//   {
//     return self::add('GET', $uri, $action);
//   }

//   public static function post(string $uri, string $action): RouteDefinition
//   {
//     return self::add('POST', $uri, $action);
//   }

//   public function put(string $uri, string $action): RouteDefinition
//   {
//     return self::add("PUT", $uri, $action);
//   }

//   public function delete(string $uri, string $action): RouteDefinition
//   {
//     return self::add("DELETE", $uri, $action);
//   }

//   public function patch(string $uri, string $action): RouteDefinition
//   {
//     return self::add("PATCH", $uri, $action);
//   }


//   // this method is used to add a route with a specific HTTP method
//   // and action (controller method)
//   // it returns an instance of RouteDefinition for further configuration
//   // such as adding middleware
//   //
//   private static function add(string $method, string $uri, string $action): RouteDefinition
//   {
//     $route = new RouteDefinition($method, $uri, $action);
//     self::$routes[] = $route;
//     return $route;
//   }

//   // هذه الدالة تستخدم لتجميع جميع المسارات في كاش
//   // لتسريع عملية البحث عن المسار المناسب
//   // وتقوم بتخزينها في مصفوفة $compiledRoutes
//   // ثم تقوم بالبحث عن المسار المناسب بناءً على الـ URI
//   // إذا تم العثور على مسار مطابق، يتم استدعاء الدالة handle
//   // الخاصة بالمسار المناسب
//   // وإذا لم يتم العثور على مسار، يتم إرجاع صفحة 404

//   public static function dispatch(string $method, string $uri): void
//   {
//     // تحميل الكاش إذا كان موجود
//     if (empty(self::$compiledRoutes)) {
//       foreach (self::$routes as $route) {
//         self::$compiledRoutes[] = [
//           'pattern' => $route->getRegex(),
//           'route' => $route
//         ];
//       }
//     }

//     foreach (self::$compiledRoutes as $entry) {
//       if (preg_match($entry['pattern'], $uri, $matches)) {
//         array_shift($matches); // حذف أول عنصر (المسار الكامل)
//         $entry['route']->handle($matches);
//         return;
//       }
//     }

//     http_response_code(404);
//     include __DIR__ . './../View/errors/404.php';
//   }
// }

// class RouteDefinition
// {
//   private string $method;
//   private string $uri;
//   private string $action;
//   private array $middleware = [];
//   private string $regex;

//   public function __construct(string $method, string $uri, string $action)
//   {
//     $this->method = $method;
//     $this->uri = $uri;
//     $this->action = $action;
//     $this->regex = $this->compileUriToRegex($uri); //compile the URI to regex
//   }

//   public function only(string|array $middleware): self
//   {
//     $this->middleware = (array)$middleware; // Ensure it's an array
//     return $this;
//   }

//   private function compileUriToRegex(string $uri): string
//   {
//     $regex = preg_replace('/\{([^}]+)\}/', '([^/]+)', $uri);
//     return '#^' . $regex . '$#';
//   } // compile the URI to regex

//   public function getRegex(): string
//   {
//     return $this->regex;
//   } // get the regex pattern for the route

//   public function handle(array $params = []): void
//   { // handle the route
//     foreach ($this->middleware as $middleware) {
//       $middlewareClass = "Core\\Middleware\\" . ucfirst($middleware) . "Middleware"; // Assuming middleware classes are named like "AuthMiddleware"
//       if (!class_exists($middlewareClass)) {
//         throw new \Exception("Middleware not found: $middlewareClass");
//       }
//       $middlewareClass::handle();
//     }

//     // دعم ملفات مباشرة إذا كانت action تنتهي بـ ".php"
//     if (str_ends_with($this->action, '.php')) {
//         $file = base_path($this->action); // اكتب دالة base_path ترجع المسار الكامل من الجذر
//         if (!file_exists($file)) {
//             throw new \Exception("File not found: $file");
//         }
//         include $file;
//         return;
//     }

//     [$controller, $method] = explode('@', $this->action); // Split the action into controller and method 
//     $controllerClass = "Controllers\\" . str_replace('/', '\\', $controller);


//     if (!class_exists($controllerClass)) {
//       throw new \Exception("Controller not found: $controllerClass");
//     }

//     $instance = new $controllerClass();

//     if (!method_exists($instance, $method)) {
//       throw new \Exception("Method $method not found in $controllerClass");
//     }

//     call_user_func_array([$instance, $method], $params);
//   }
// }
