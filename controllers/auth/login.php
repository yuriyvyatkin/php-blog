<?php

  if ($userVerified) {
    header('Location: ' . BASE_URL . 'not_found', true, 301);

    exit;
  }

  $error = NULL;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remember = isset($_POST['remember']);
    unset($_POST['remember']);

    foreach ($_POST as $key => &$value) {
      $value = trim($value);

      if (empty($value)) {
        $error = composeError($key);

        break;
      }
    }

    if (empty($error)) {
      $user = getUserByLogin($_POST['login']);

      if ($user && password_verify($_POST['password'], $user['password'])) {
        $token = substr(bin2hex(random_bytes(128)), 0, 128);

        addSession($user['id_user'], $token);

        $_SESSION['token'] = $token;

        if ($remember) {
          setcookie('token', $token, time() + 3600 * 24 * 30, BASE_URL);
        }

        header('Location: ' . BASE_URL, true, 301);

        exit;
      } else {
        $error = 'Incorrect credentials!';
      }
    }
  }

  $pageTitle = 'Login';
  $pageH1 = 'Login';
  $pageContent = template('auth/v_login', [
    'error' => $error
  ]);
