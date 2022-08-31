<?php

  declare(strict_types = 1);

  function sanitizeInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function composeError(string $field): string {
    return 'Field “' . ucfirst($field) . '” not filled in';
  }
