<?php

class Produto {
    private $conn;   
    
    public function __construct() {
        $host = "65.108.237.84";
        $db = "prog_web";
        $user = "usrapp";
        $pass = "010203";

        // Criar conexão com o banco de dados
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        // Verificar se houve erro na conexão
        if ($this->conn->connect_error) {
            die("Erro na conexão: " . $this->conn->connect_error);
        }
    }
    
    // Método para adicionar um novo produto
    public function adicionarProduto($nome, $descricao, $preco, $quantidade) {
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (?, ?, ?, ?)";
        
        // Preparar a consulta
        if ($stmt = $this->conn->prepare($sql)) {
            // Vincular os parâmetros
            $stmt->bind_param("ssdi", $nome, $descricao, $preco, $quantidade);

            // Executar a consulta
            if ($stmt->execute()) {
                echo "Produto adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar o produto: " . $this->conn->error;
            }

            // Fechar a instrução
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $this->conn->error;
        }
    }

    // Método para listar todos os produtos
    public function listarProdutos() {
        $sql = "SELECT * FROM produtos";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $produtos = [];

            // Buscar cada linha de resultado e armazenar no array
            while ($row = $result->fetch_assoc()) {
                $produtos[] = $row;
            }

            return $produtos;
        } else {
            return [];
        }
    }

    // Fechar a conexão com o banco de dados
    public function fecharConexao() {
        $this->conn->close();
    }
}
?>
