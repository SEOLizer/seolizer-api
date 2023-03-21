<?php

error_reporting(0);


if (file_exists('config/conf.php')) {
  require_once('config/conf.php');
  require_once('libs/https.php');

  if (file_exists('libs/commands/' . $command . '.php')) {
      require_once('libs/commands/' . $command . '.php');
      $phpCommand = 'sapi_' . $command;
      $result = $phpCommand($para);
  } else {
      echo("function not found\n");
  }

} else {
  echo("No configuration with API key has been created yet. Please complete the installation first.");
}
