<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $categories = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = (int) ($_POST['id_category'] ?? null);

    $_SESSION['response_code'] = deleteCategory($categoryId);
    $_SESSION['entity'] = 'category';
    $_SESSION['action'] = 'deleted';

    header('Location: ' . BASE_URL, true, 301);

    exit;
  } else {
    $categories = getAllCategories();
    $pageTitle = 'Delete category | Categories editor';
    $pageH1 = 'Delete category';
    $pageContent = template('categories/v_delete', [
      'categories' => $categories,
    ]);
  };
