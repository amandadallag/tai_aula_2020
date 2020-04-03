<?php

class BD
{

    public function connection()
    {
        $bd_tipo = "mysql";
        $host = "localhost";
        $bd_nome = "db_tai_aula_2020";
        $bd_porta = "3306";
        $bd_usuario = "root";
        $bd_senha = "";
        $bd_charset = "utf8";

        $str_conn = $bd_tipo . ":host=" . $host . ";dbname=" . $bd_nome . ";port=" . $bd_porta;;

        return new PDO(
            $str_conn,
            $bd_usuario,
            $bd_senha,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $bd_charset)
        );
    }

    public function selectAll()
    {

        $conn = $this->connection();
        $stmt = $conn->prepare("SELECT * FROM cliente order by nome");
        $stmt->execute();

        return $stmt;
    }

    public function insert($dados)
    {

         var_dump($dados);
         
        $sql = "INSERT INTO `cliente` (`nome`, `telefone`, `cpf`, `e-mail`) 
            VALUES (?, ?, ?, ?);";

        $conn = $this->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $dados['nome'],
            $dados['telefone'], $dados['cpf'], $dados['e-mail']
        ]);

        return $stmt;
    }
}

    $dados = array(
    "nome" => "João",
    "telefone" => "84 98855-5500",
    "cpf" => "55500055588",
    "e-mail" => "lordjoao@gmail.com"
);

$obj = new BD;
$obj->connection();

$result = $obj->selectAll();

$obj->insert($_POST);

echo "
<table style='width:100%'>
  <tr>
    <th>ID</th>
    <th>nome</th>
    <th>CPF</th>
  </tr>
  ";
foreach ($result as $item) {
  echo "
  <tr>
    <td>".$item['id'] ." </td>
    <td>".$item['nome'] ." </td>
    <td>".$item['cpf'] ." </td>
    <td><a href='/formeditarCliente.php?id=".$item['id']."'> Editar </a></td>
    ";
}
echo"</table>";
