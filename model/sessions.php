<?php

  function addSession(int $userId, string $token): string {
    $fields = ['id_user' => $userId, 'token' => $token];

    $sql = "INSERT sessions (id_user, token) VALUES (:id_user, :token)";

    return dbQuery($sql, $fields)->errorCode();
  }

  function getSession(string $token): array|bool
  {
    $sql = "SELECT * FROM sessions WHERE token=:token";

    $query = dbQuery($sql, ['token' => $token]);

    return $query->fetch();
  }
