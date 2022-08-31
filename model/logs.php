<?php

  function getCategories(): array
  {
    $categories = scandir("logs/");

    return array_diff($categories, ['.', '..']);
  }

  function getCategoryName(string $category): string
  {
    return str_replace('_', ' ', ucfirst($category));
  }

  function checkFileName(string $name): bool
  {
    return !!preg_match('/^\d{4}\-\d{2}\-\d{2}\.txt$/', $name);
  }

  function isFile(string $date, ?string $type = null): bool
  {
    $route = $type ?? 'visits';

    return file_exists("logs/$route/$date");
  }

  function getFileNamesByDays(?string $type = null): array
  {
    $route = $type ?? 'visits';

    $files = scandir("logs/$route");

    array_walk($files, function(&$value, $key, $route) {
      if (!is_file("logs/$route/$value") || !checkFileName($value)) {
        $value = '';
      }
    }, $route);

    return array_reverse(array_filter($files, fn($file) => $file !== ''));
  }

  function getLines(string $date, ?string $type = null): array
  {
    $route = $type ?? 'visits';

    $lines = file("logs/$route/$date");

    return array_map(function($line) {
      return json_decode(rtrim($line), true);
    }, $lines);
  }

  function addVisitLog(): bool
  {
    $logName = date("Y-m-d");

    $info = [
      'dt' => date("H:i:s"),
      'ip' => $_SERVER['REMOTE_ADDR'],
      'uri' => $_SERVER['REQUEST_URI'],
      'referer' => $_SERVER['HTTP_REFERER'] ?? ''
    ];

    $log = json_encode($info) . "\n";

    file_put_contents("logs/visits/$logName.txt", $log, FILE_APPEND);

    return true;
  }
