<?php

  $id = (int) URL_PARAMS['id'];

  $article = getArticle($id);

  if ($article) {
    if ($article['title'] === 'Article with a fatal error') {
      throw new Error('An error occured!');
    }

    $pageTitle = $article['title'];
    $pageH1 = 'Article';
    $pageLeft = template('articles/v_menu', [
      'id_article' => $article['id_article'],
    ]);
    $article['content'] = preg_split('#<br\s*/?>#i', $article['content']);
    $pageContent = template('articles/v_article', [
      'article' => $article,
    ]);

    if (empty($userVerified)) {
      $pageTemplate = 'v_main';
    } else {
      $pageTemplate = 'v_main2col';
    }
  } else {
    include_once('controllers/responses/404.php');
  }
