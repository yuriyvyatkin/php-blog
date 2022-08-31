<?php

  header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");

  $pageTitle = 'Error 404';
  $pageH1 = 'Error 404';
  $pageContent = template('responses/v_404');
