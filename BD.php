<?php

class BD
{

    public function connection()
    {
        $host = "localhost";
        $db_nome = "db_tai_aula_2020";
        $db_usuario = "root";
        $db_senha = "123456";
        $db_charset = "utf8";
        $str_conn = "mysql:host=" . $host . ";dbname=" . $db_nome;

        return new PDO(
            $str_conn,
            $db_usuario,
            $db_senha,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $db_charset)
        );
    }

    public function selectAll()
    {

        $conn = $this->connection();
        $stmt = $conn->prepare("SELECT * FROM cliente order by nome");
        $stmt->execute();

        return $stmt;
    }

    public function insert($dados){
        
        $sql = "INSERT INTO cliente (nome, telefone, cpf, e-mail) 
            VALUES (?, ?, ?, ?);";

        $conn = $this->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $dados['nome'],
            $dados['telefone'],$dados['cpf'],$dados['e-mail'] ]);

        return $stmt;

    }
}

$dados = array(
    "nome" => "João",
    "telefone" => "84 98855-5500",
    "cpf" => "55500055588",
    "e-mail"=> "lordjoao@gmail.com"
);

$obj = new BD;
$obj->connection();

$result = $obj->selectAll();

$obj->insert($dados);

foreach ($result as $item) {
    echo $item['id'] . "-" . $item['nome'] . "<br>";
}
