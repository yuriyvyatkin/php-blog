<?php

  function logout(): void {
    unset($_SESSION['token']);

    setcookie('token', NULL);
  }

  function verifyUser(): ?bool {
    $user = NULL;
    $token = $_SESSION['token'] ?? $_COOKIE['token'] ?? NULL;

    if (isset($token)) {
      $session = getSession($token);

      if ($session) {
        $user = getUserById($session['id_user']);
      } else {
        logout();
      }
    }

    return (bool) $user;
  }
