<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $file = URL_PARAMS['filename'];
  $type = URL_PARAMS['type'];

  $fileName = pathinfo($file, PATHINFO_FILENAME);
  $headers = [];
  if ($type === 'visits') {
    $headers = ['Time', 'IP', 'URI', 'Referer'];
  } elseif (str_contains($type, 'errors')) {
    $headers = ['Time', 'Message'];
  }
  $fileNotFound = !isFile($file, $type);
  $pageTitle = 'Log entries';
  $pageH1 = 'Log entries';
  $lines = null;

  if ($fileNotFound) {
    $pageContent = template('responses/v_204');
  } else {
    $lines = getLines($file, $type);
    $locationVars = ['fileName', 'headers', 'lines'];
    $pageContent = template('logs/v_log', compact($locationVars));
  }
