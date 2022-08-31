<?php

  $articleID = (int) (URL_PARAMS['id'] ?? null);

  $_SESSION['response_code'] = deleteArticle($articleID);
  $_SESSION['entity'] = 'article';
  $_SESSION['action'] = 'deleted';

  header('Location: ' . BASE_URL, true, 301);
