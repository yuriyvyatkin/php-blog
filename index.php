<?php

  session_start();

  include_once('init.php');

  addVisitLog();

  $userVerified = verifyUser();

  $parsedURL = getParsedURL($_SERVER['REQUEST_URI']);

  if (hasDoubleSlash($parsedURL['path'])) {
    $redirectURL = preg_replace('#\/{2,}#', '/', $parsedURL['path']);

    if ($parsedURL['query']) {
      $redirectURL .= '?' . $parsedURL['query'];
    }

    header("Location: $redirectURL", true, 301);

    exit;
  }

  $controllerData = parseCustomQuery(
    $_GET['custom_query'] ?? '',
    include('routes.php')
  );

  define('URL_PARAMS', $controllerData['params']);
  $path = $controllerData['path'];

  $pageLeft = '';
  $pageTemplate = 'v_main';

  if (file_exists($path)) {
    include_once($path);
  } else {
    include_once('controllers/errors/500.php');
  }

  $html = template("base/$pageTemplate", [
    'userVerified' => $userVerified,
    'activeNav' => explode('/', $_GET['custom_query'] ?? '')[0],
    'title' => $pageTitle . ' | Blog',
    'h1' => $pageH1,
    'content' => $pageContent,
    'left' => $pageLeft,
  ]);

  echo $html;
