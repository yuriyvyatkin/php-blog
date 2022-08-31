<?php

  header("{$_SERVER['SERVER_PROTOCOL']} 204 No Content");

  $pageTitle = 'No content';
  $pageH1 = 'No content';
  $pageContent = template('responses/v_204');
