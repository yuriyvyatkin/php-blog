<?php

  declare(strict_types = 1);

  function saveErrorLog(int $errorType, string $errorMessage) {
    $route = 'other_errors';

    if ($errorType === E_ERROR) {
      $route = 'fatal_errors';
    }

    $filename = ROOT_PATH . '/logs/' . $route . '/' . date('Y-m-d') . '.txt';

    $log = fopen($filename, 'a');

    $time = date('H:i:s', $_SERVER['REQUEST_TIME']);

    $logData = json_encode(compact('time', 'errorMessage'));

    fwrite($log, $logData . PHP_EOL);

    fclose($log);
  }

  function shutdownHandler(string $html) {
    $last_error = error_get_last();

    if ($last_error !== NULL && $last_error['type'] === E_ERROR) {
      header("{$_SERVER['SERVER_PROTOCOL']} 500 Internal Server Error");

      echo str_replace('%BASE_URL%', BASE_URL, $html);

      saveErrorLog($last_error['type'], $last_error['message']);
    }
  }
