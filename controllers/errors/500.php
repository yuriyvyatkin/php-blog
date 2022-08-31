<?php

  header("{$_SERVER['SERVER_PROTOCOL']} 500 Internal Server Error");

  $pageTitle = 'Error 500';
  $pageH1 = 'Error 500';
  $pageContent = template('errors/v_500');
