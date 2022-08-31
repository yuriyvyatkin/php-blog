<?php declare(strict_types = 1);

  function getUserByLogin(string $login): array|bool
  {
    $sql = "SELECT id_user, password FROM users WHERE login=:login";

    $query = dbQuery($sql, ['login' => $login]);

    return $query->fetch();
  }

  function getUserById(string $id): array|bool
  {
    $sql = "SELECT id_user, login, email, name FROM users WHERE id_user=:id";

    $query = dbQuery($sql, ['id' => $id]);

    return $query->fetch();
  }
