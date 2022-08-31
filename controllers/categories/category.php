<?php

  $id = (int) URL_PARAMS['id'];

  $articles = getArticlesByCategory($id);

  if (count($articles)) {
    $categoryTitle = $articles[0]['category_title'];
    $pageTitle = $categoryTitle;
    $pageH1 = "Articles of category \"$categoryTitle\":";
    $pageContent = template("articles/components/v_articles_list", ['articles' => $articles]);
  } else {
    include_once('controllers/responses/204.php');
  }
