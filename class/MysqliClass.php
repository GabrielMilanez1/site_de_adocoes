<?php

require_once 'Config.php';

class MysqliClass
{

  private $server_name;
  private $username;
  private $password;
  private $db_name;
  private $mysqli_connection;
  private $conn;
  
  function __construct()
  {
    $this->server_name = Config::getServerName();
    $this->username = Config::getUsername();;
    $this->password = Config::getPassword();
    $this->db_name = Config::getDbName();

    $this->mysqli_connection = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);
    $this->conn = mysqli_connect($this->server_name, $this->username, $this->password, $this->db_name);
  }

  public function getResultsQuery($query)
  {
    $result = mysqli_query($this->conn, $query);

    if ($result) {
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
      return false;
    } 
  }

  public function gravaUsuario($nome, $username, $email, $senha, $genero)
  {
    $query = "INSERT INTO `tb_usuario` (`nome`, `username`, `email`, `senha`, `genero`) VALUES (?, ?, ?, ?, ?)";
    $senha = (string) md5($senha);
    
    $stmt = $this->mysqli_connection->prepare($query);
    $stmt->bind_param("sssss", strip_tags($nome), strip_tags($username), strip_tags($email), $senha, strip_tags($genero));

    $insert = $stmt->execute();

    if ($insert) {
      return true;
    }

    return false;
  }

  public function getUser($identificacao)
  {
    $db = new MysqliClass();
    $query = "SELECT * FROM tb_usuario WHERE";
    $identificacao = "'" . $identificacao . "'";

    $usuario = $db->getResultsQuery("{$query} username = {$identificacao}");

    if (count($usuario) <= 0) {
      $usuario = $db->getResultsQuery("{$query} email = {$identificacao}");
      if (count($usuario) <= 0) {
        return false;
      }
    }
      return $usuario[0];
  }

  public function getUserById($identificacao)
  {
    $db = new MysqliClass();
    $query = "SELECT * FROM tb_usuario WHERE";
    $identificacao = "'" . $identificacao . "'";

    $usuario = $db->getResultsQuery("{$query} id = {$identificacao}");

    if (count($usuario) <= 0) {
      return false;
    }
      return $usuario[0];
  }

  public function getEspecie($identificacao)
  {
    $db = new MysqliClass();
    $query = "SELECT * FROM tb_especies WHERE";
    $identificacao = "'" . $identificacao . "'";

    $especie = $db->getResultsQuery("{$query} id = {$identificacao}");

    if (count($especie) <= 0) {
      return false;
    }
      return $especie[0]; 
  }

  public function gravaAnimal($especie, $caracteristicas, $idade, $peso, $imagem, $usuario_responsavel, $ativo = 1)
  {
    $query = "INSERT INTO `tb_animais` (`especie`, `caracteristicas`, `idade`, `peso`, `imagem`, `usuario_responsavel`, `ativo`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->mysqli_connection->prepare($query);
    $stmt->bind_param("isddsii", $especie, strip_tags($caracteristicas), $idade, $peso, $imagem, $usuario_responsavel, $ativo);

    $insert = $stmt->execute();

    if ($insert) {
      return true;
    }

    return false;
  }
  
}