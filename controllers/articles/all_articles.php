<?php

  $articles = getAllArticles();
  $pageTitle = 'All articles';
  $pageH1 = 'All articles';

  $pageContent = template("articles/v_index", [
    'articles' => $articles,
    'responseCode' => $_SESSION['response_code'] ?? NULL,
    'entity' => $_SESSION['entity'] ?? NULL,
    'action' => $_SESSION['action'] ?? NULL,
  ]);

  unset($_SESSION['response_code']);
  unset($_SESSION['entity']);
  unset($_SESSION['action']);
