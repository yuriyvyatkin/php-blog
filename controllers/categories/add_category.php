<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $error = NULL;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => &$value) {
      $value = sanitizeInput($value);

      if (empty($value)) {
        $error = composeError($key);

        break;
      }
    }

    if (empty($error)) {
      $_SESSION['response_code'] = addCategory($_POST);
      $_SESSION['entity'] = 'category';
      $_SESSION['action'] = 'added';

      header('Location: ' . BASE_URL, true, 301);

      exit;
    }
  }

  $pageTitle = 'Add category | Categories editor';
  $pageH1 = 'Add category';
  $pageContent = template('categories/v_add', [
    'fields' => $_POST,
    'error' => $error,
  ]);
