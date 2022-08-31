<?php

  declare(strict_types = 1);

  function template(string $path, array $vars = []): string {
    static $twig;

    if ($twig === null) {
      $loader = new \Twig\Loader\FilesystemLoader('views');

      $twig = new \Twig\Environment($loader, [
        'cache' => 'cache/twig',
        'auto_reload' => true,
        'autoescape' => false,
        'strict_variables' => true,
      ]);
    }

    return $twig->render("$path.twig", array_merge($vars, ['BASE_URL' => BASE_URL]));
  }

  function parseCustomQuery(string $customQuery, array $routes): ?array {
    $result = [
      'path' => 'controllers/responses/404.php',
      'params' => []
    ];

    foreach ($routes as $route) {
      if (preg_match($route['test'], $customQuery, $matches)) {

        $result['path'] = "controllers/{$route['controller']}.php";

        if (isset($route['components'])) {
          foreach($route['components'] as $name => $sequenceNumber) {
            $result['params'][$name] = $matches[$sequenceNumber];
          }
        }

        break;
      }
    }

    return $result;
  }

  function getBaseUrl(): string {
    static $baseUrl;

    if ($baseUrl === null) {
      $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

      $IP = $_SERVER['HTTP_HOST'];

      if (in_array($IP, ['localhost', '::1', '127.0.0.1'])) {
        $tmpURL = dirname(__FILE__);

        $tmpURL = str_replace('\\', '/', $tmpURL);

        $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $tmpURL);

        $tmpURL = trim($tmpURL,'/');

        if (strpos($tmpURL, '/')) {
          $tmpURL = explode('/', $tmpURL);

          $tmpURL = $tmpURL[0];
        }

        $baseUrl .= "{$_SERVER['HTTP_HOST']}/$tmpURL/";
      } else {
        $baseUrl .= "{$_SERVER['HTTP_HOST']}/";
      }
    }

    return $baseUrl;
  }

  function getParsedURL(string $uri): array {
    $parts = explode('?', $uri);

    return [
      'path' => $parts[0] ?? NULL,
      'query' => $parts[1] ?? NULL,
    ];
  }

  function hasDoubleSlash(string $uri): bool {
    $pattern = '#\/{2,}#';
    return !!preg_match($pattern, $uri);
  }
