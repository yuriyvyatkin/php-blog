<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $error = NULL;
  $categories = getAllCategories();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => &$value) {
      $value = sanitizeInput($value);

      if (empty($value)) {
        $error = composeError($key);

        break;
      }
    }

    if (empty($error)) {
      $_POST['content'] = str_replace("\n\r", '<br>', $_POST['content']);

      $_SESSION['response_code'] = addArticle($_POST);
      $_SESSION['entity'] = 'article';
      $_SESSION['action'] = 'added';

      header('Location: ' . BASE_URL, true, 301);

      exit;
    }
  }

  $pageTitle = 'Add article';
  $pageH1 = 'Add article';
  $pageContent = template('articles/v_add', [
    'fields' => $_POST,
    'categories' => $categories,
    'error' => $error,
  ]);
