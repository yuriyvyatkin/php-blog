<?php declare(strict_types = 1);

  function addCategory(array $fields): string
  {
    $sql = "INSERT categories (title) VALUES (:title)";

    return dbQuery($sql, $fields)->errorCode();
  }

  function getAllCategories(): array
  {
    $sql = "SELECT * FROM categories ORDER BY title";

    $query = dbQuery($sql);

    return $query->fetchAll();
  }

  function editCategory(array $fields): string
  {
    $fieldsSet = '';

    foreach ($fields as $key => $value) {
      if ($key === 'id_category') {
        continue;
      }

      $fieldsSet .= "$key=:$key, ";
    }

    $fieldsSet = rtrim($fieldsSet, ", ");

    $sql = "UPDATE categories SET $fieldsSet WHERE id_category=:id_category";

    return dbQuery($sql, $fields)->errorCode();
  }

  function deleteCategory(?int $id = null): string
  {
    $sql = "DELETE FROM categories WHERE id_category=:id";

    return dbQuery($sql, ['id' => $id])->errorCode();
  }
