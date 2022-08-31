<?php

  declare(strict_types = 1);

  function dbConnect(): PDO {
    static $db;

    if ($db === null) {
      $cleardbUrl = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $cleardbHost = $cleardbUrl["host"];
      $cleardbName = substr($cleardbUrl["path"], 1);
      $cleardbUsername = $cleardbUrl["user"];
      $cleardbPassword = $cleardbUrl["pass"];

      $db = new PDO(
        'mysql:host=' . $cleardbHost . ';dbname=' . $cleardbName . ';charset=UTF8',
        $cleardbUsername,
        $cleardbPassword,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
      );
    }

    return $db;
  }

  function dbQuery(string $sql, array $params = []): PDOStatement {
    $db = dbConnect();

    $query = $db->prepare($sql);

    $query->execute($params);

    return $query;
  }
