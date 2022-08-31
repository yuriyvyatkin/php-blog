<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $categories = getCategories();

  $categoriesData = [];

  foreach ($categories as $value) {
    $categoriesData[] = [
      'initialName' => $value,
      'name' => getCategoryName($value),
      'filesAmount' => count(getFileNamesByDays($value)),
    ];
  }

  $pageTitle = 'Logs categories';
  $pageH1 = 'Logs categories';
  $pageContent = template('logs/v_categories', [
    'categoriesData' => $categoriesData
  ]);
