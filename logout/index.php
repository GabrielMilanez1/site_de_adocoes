<?php
  require_once '../session/session_start.php';
  session_destroy();
  header('location: /');
?>