<?php

  $id = null;
  $fields = null;
  $categories = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => &$value) {
      $value = sanitizeInput($value);
      if (empty($value)) {
        unset($_POST[$key]);
      }
    }

    $_POST['content'] = str_replace("\n\r", '<br>', $_POST['content']);

    if (count($_POST) > 1) {
      $_SESSION['response_code'] = editArticle($_POST);
      $_SESSION['entity'] = 'article';
      $_SESSION['action'] = 'edited';
    }

    header('Location: ' . BASE_URL, true, 301);

    exit;
  } else {
    $id = (int) (URL_PARAMS['id'] ?? '');
    $fields = getArticle($id);
    if ($fields) {
      $fields['content'] = preg_replace('#<br\s*/?>#i', '', $fields['content']);
      $categories = getAllCategories();
      $pageTitle = 'Edit article';
      $pageH1 = 'Edit article';
      $pageContent = template('articles/v_edit', [
        'fields' => $fields,
        'categories' => $categories,
      ]);
    } else {
      include_once('controllers/responses/404.php');
    }
  }
