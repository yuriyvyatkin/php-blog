<?php

  if (empty($userVerified)) {
    header('Location: ' . BASE_URL . '/login', true, 301);

    exit;
  }

  $type = URL_PARAMS['type'];

  $fileNames = getFileNamesByDays($type);

  if (empty($fileNames)) {
    $pageContent = template('responses/v_204');
  } else {
    $locationVars = ['fileNames', 'type'];
    $pageContent = template('logs/v_logs', compact($locationVars));
  }

  $categoryName = getCategoryName($type);
  $pageTitle = $categoryName. ' logs';
  $pageH1 = $categoryName . ' logs';
