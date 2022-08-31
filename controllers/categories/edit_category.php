<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $categories = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => &$value) {
      $value = sanitizeInput($value);
      if (empty($value)) {
        unset($_POST[$key]);
      }
    }

    if (count($_POST) > 1) {
      $_SESSION['response_code'] = editCategory($_POST);
      $_SESSION['entity'] = 'category';
      $_SESSION['action'] = 'edited';
    }

    header('Location: ' . BASE_URL, true, 301);

    exit;
  } else {
    $categories = getAllCategories();
    $pageTitle = 'Edit category | Categories editor';
    $pageH1 = 'Edit category';
    $pageContent = template('categories/v_edit', [
      'categories' => $categories,
    ]);
  }
