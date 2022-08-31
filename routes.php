<?php

return (function(){
  $id = '[1-9]+\d{0,18}';
  $logsTypes = 'fatal_errors|other_errors|visits';

  return [
    [
      'test' => '#^$#',
      'controller' => 'articles/all_articles'
    ],
    [
      'test' => '#^add_article\/?$#',
      'controller' => 'articles/add_article'
    ],
    [
      'test' => "#^article\/($id)\/?$#",
      'controller' => 'articles/article',
      'components' => ['id' => 1]
    ],
    [
      'test' => "#^article\/($id)\/edit_article\/?$#",
      'controller' => 'articles/edit_article',
      'components' => ['id' => 1]
    ],
    [
      'test' => "#^article\/($id)\/delete_article\/?$#",
      'controller' => 'articles/delete_article',
      'components' => ['id' => 1]
    ],
    [
      'test' => "#^category\/($id)\/?$#",
      'controller' => 'categories/category',
      'components' => ['id' => 1]
    ],
    [
      'test' => '#^categories_editor/add_category\/?$#',
      'controller' => 'categories/add_category'
    ],
    [
      'test' => '#^categories_editor/edit_category\/?$#',
      'controller' => 'categories/edit_category'
    ],
    [
      'test' => '#^categories_editor/delete_category\/?$#',
      'controller' => 'categories/delete_category'
    ],
    [
      'test' => '#^logs_journal\/?$#',
      'controller' => 'logs/logs_categories',
    ],
    [
      'test' => "#^logs_journal\/($logsTypes)\/?$#",
      'controller' => 'logs/logs_by_days',
      'components' => ['type' => 1]
    ],
    [
      'test' => "#^logs_journal\/($logsTypes)\/(\d{4}\-\d{2}\-\d{2}\.txt)$#",
      'controller' => 'logs/log_entries',
      'components' => ['type' => 1, 'filename' => 2]
    ],
    [
      'test' => "#^login\/?$#",
      'controller' => 'auth/login'
    ],
    [
      'test' => "#^logout$#",
      'controller' => 'auth/logout'
    ]
  ];
})();
