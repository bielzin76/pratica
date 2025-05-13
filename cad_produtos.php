<?php
// Inclui o arquivo de conexão com o banco de dados
require 'config/db.php';

// Verifica se o formulário foi enviado pelo método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['preco']) && !empty($_POST['descricao']) && !empty($_POST['url'])) {
        
        // Recebe e armazena os dados do formulário
        $nome = trim($_POST['nome']);            // Nome do produto
        $preco = floatval($_POST['preco']);      // Preço (convertido para número com ponto flutuante)
        $descricao = trim($_POST['descricao']);  // Descrição do produto
        $url = trim($_POST['url']);              // URL da imagem do produto

        // Prepara a instrução SQL com placeholders (para evitar SQL Injection)
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, descricao, url) VALUES (?, ?, ?, ?)");

        // Verifica se o prepare foi bem-sucedido
        if ($stmt) {
            // Vincula os parâmetros à instrução SQL
            $stmt->bind_param("sdss", $nome, $preco, $descricao, $url); // s = string, d = double (float)

            // Executa a query e verifica se foi bem-sucedida
            if ($stmt->execute()) {
                // Redireciona com mensagem de sucesso
                header("Location: index.php?sucesso=1");
                exit;
            } else {
                echo "Erro ao executar: " . $stmt->error;
            }

            // Fecha o statement
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $conn->error;
        }

    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>
