<?php

class BD
{

    //metodo para conexao com o banco de dados
    public function connection()
    {
        //variaveis para configurar a conexao com o banco de dados
        $bd_tipo = "mysql";
        $host = "localhost";
        $bd_nome = "db_tai_aula_2020";
        $bd_porta = "3306";
        $bd_usuario = "root";
        $bd_senha = "";
        $bd_charset = "utf8";

        $str_conn = $bd_tipo . ":host=" . $host . ";dbname=" . $bd_nome . ";port=" . $bd_porta;;

        //retorna um objeto PDO com os seus atributos e metodos para manipular o Banco de dado
        return new PDO(
            $str_conn,
            $bd_usuario,
            $bd_senha,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $bd_charset)
        );
    }

    public function selectAll($tabela = 'cliente')
    {

        $conn = $this->connection(); // conecta o banco de dados
        //prepara o select da tabela
        $stmt = $conn->prepare("SELECT * FROM $tabela order by id desc");
        //executa o SQL
        $stmt->execute();
        //retorna a execução no formato de um Array
        return $stmt;
    }

    //funcao para buscar um registro no banco de dados através de um ID
    public function find($id, $tabela = "cliente")
    {
        $conn = $this->connection(); // conecta o banco de dados
        //prepara o select da tabela fazendo um Where pelo id
        $stmt = $conn->prepare("SELECT * FROM $tabela WHERE id = ?");
        //executa o SQL
        $stmt->execute([$id]);
        //retorna a execução no formato de um objeto
        return $stmt->fetchObject();
    }
    
    public function search($dados) 
    {
        $campo = $dados['tipo'];
        $conn = $this -> connection();
        $stmt = $conn -> prepare("SELECT * FROM cliente WHERE $campo LIKE BINARY ?");
        $stmt -> execute(["%".$dados."%"]);
        return $stmt;
    }

    //funcao para atualziar os dados de um formulario
    public function update($dados)
    {

        //sintaxe do SQL para atualizar um cliente
        $sql = "UPDATE `cliente` SET `nome`= ?, `telefone`= ?, `cpf`= ?,
         `email`= ?, municipio_id = ? WHERE id= ? ;";

        $conn = $this->connection(); //conecta ao banco de dados
        //prepara o SQL
        $stmt = $conn->prepare($sql);
        //execulta o SQL substituindo onde tem a iterrogacao pelos parametros 
        //passados atraves do vetor seguindo a mesma sequencia da esqueda para direita
        //sendo o $dados['nome'] a representacao da primeira interrogacao e assim por diante
        //o ultimo e o id representa o registro que sera alterado
        $stmt->execute([
            $dados['nome'],
            $dados['telefone'], $dados['cpf'], $dados['email'], $dados['municipio_id'], $dados['id']
        ]);

        //retorna verdadeiro ou falso se executou a operacao
        return $stmt;
    }

    //funcao para realizer o insert de um registro no banco de dado 
    public function insert($dados)
    {
        var_dump($dados);
        //sql do Insert
        $sql = "INSERT INTO `cliente` (`nome`, `telefone`, `cpf`, `email`, `municipio_id`) 
            VALUES (?, ?, ?, ?, ?);";

        $conn = $this->connection(); //conecta ao banco de dado
        //prepara o SQL
        $stmt = $conn->prepare($sql);
        //execulta o SQL substituindo onde tem a iterrogacao pelos parametros 
        //passados atraves do vetor seguindo a mesma sequencia da esqueda para direita
        //sendo o $dados['nome'] a representacao da primeira interrogacao e assim por diante
        $stmt->execute([
            $dados['nome'],
            $dados['telefone'], $dados['cpf'], $dados['email'], $dados['municipio_id']
        ]);

        //retorna verdadeiro ou falso se executou a operacao
        return $stmt;
    }
      //funcao para deletar um registro no banco de dados através de um ID
      public function deletar($id)
      {
        //  var_dump($id);
         // exit;
          $conn = $this->connection(); // conecta o banco de dados
          //prepara o deletar o registro da tabela fazendo um Where pelo id
          $stmt = $conn->prepare("DELETE FROM `cliente` WHERE `id` = ?;");
          //executa o SQL
          $stmt->execute([$id]);
          //retorna a execução no formato de um objeto
          return $stmt;
      }
}
