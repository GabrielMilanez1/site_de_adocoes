<?php

Class LoginService
{
  
  public static function login($identificacao, $password)
  {
    $db = new MysqliClass();
    $user = $db->getUser($identificacao);
  
    if ($user && $user['senha'] === (string) md5($password)) {
      return $user;
    }

    return false;
  }

  public static function usuarioLogado()
  {
    $logado = isset($_SESSION['username']) && !empty($_SESSION['username']);

    if ($logado) {
      return true;
    } else {
      return false;
    }
    
  }

}