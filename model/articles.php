<?php declare(strict_types = 1);

  function addArticle(array $fields): string
  {
    $sql = "INSERT articles (id_category, title, content) VALUES (:id_category, :title, :content)";

    return dbQuery($sql, $fields)->errorCode();
  }

  function getAllArticles(): array
  {
    $sql = "SELECT * FROM articles ORDER BY id_article DESC";

    $query = dbQuery($sql);

    return $query->fetchAll();
  }

  function getArticlesByCategory(?int $id = null): array
  {
    $sql = "SELECT articles.*, categories.title as category_title FROM articles JOIN categories USING (id_category) WHERE id_category=:id ORDER BY id_article DESC";

    $query = dbQuery($sql, ['id' => $id]);

    return $query->fetchAll();
  }

  function getArticle(int $id): array|bool
  {
    $sql = "SELECT articles.*, categories.title as category_title FROM articles JOIN categories USING (id_category) WHERE id_article=:id";

    $query = dbQuery($sql, ['id' => $id]);

    return $query->fetch();
  }

  function editArticle(array $fields): string
  {
    $fieldsSet = '';

    foreach ($fields as $key => $value) {
      if ($key === 'id_article') {
        continue;
      }

      $fieldsSet .= "$key=:$key, ";
    }

    $fieldsSet = rtrim($fieldsSet, ", ");

    $sql = "UPDATE articles SET $fieldsSet WHERE id_article=:id_article";

    return dbQuery($sql, $fields)->errorCode();
  }

  function deleteArticle(?int $id = null): string
  {
    $sql = "DELETE FROM articles WHERE id_article=:id";

    return dbQuery($sql, ['id' => $id])->errorCode();
  }
