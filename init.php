<?php

  include_once('vendor/autoload.php');

  const ROOT_PATH = __DIR__;

  include_once('core/db.php');
  include_once('core/errors.php');
  include_once('core/get.php');
  include_once('core/post.php');
  include_once('core/auth.php');

  define('BASE_URL', getBaseUrl());

  include_once('model/articles.php');
  include_once('model/categories.php');
  include_once('model/logs.php');
  include_once('model/users.php');
  include_once('model/sessions.php');

  setlocale(LC_ALL, 'en-US');

  ini_set('display_errors', '0');

  set_error_handler('saveErrorLog');

  $shutdownMessage = file_get_contents('views/errors/v_fatal_error.twig');
  register_shutdown_function('shutdownHandler', $shutdownMessage);
