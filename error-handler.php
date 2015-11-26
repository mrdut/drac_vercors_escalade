<?php

function sendMail($errno, $errstr, $errfile, $errline, $status)
{
  $subject = "[Open de Bloc] Erreur: " . date("l d F Y, H:i:s");
  $body = "Code: $errno\r\n"
  . "Message: $errstr\r\n"
  . "File: $errfile\r\n"
  . "Line: $errline\r\n"
  . "Status: $status\r\n";

  mail("romain.goffe@gmail.com", $subject, $body);
  error_log("$subject\r\n $body");
}

function handleError($errno, $errstr, $errfile, $errline)
{
  // Developer error info
  if (is_array($_SESSION['error']))
  {
    $error= implode($_SESSION['error']);
  }
  else if (is_string($_SESSION['error']))
  {
    $error = $_SESSION['error'];
  }

  sendMail($errno, $errstr, $errfile, $errline, $error);

  // User error info
  if ($errno == E_USER_NOTICE)
  {
    $_SESSION['user-error-str'] = $errstr;
  }

  ob_end_clean();
  header("Location: error.php");
  exit();
}

?>
