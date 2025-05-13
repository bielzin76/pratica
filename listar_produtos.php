<?php
session_start();
require 'config/db.php';

header('Content-Type: application/json');

// Conexão com banco de dados
$servername = "localhost";
$username = "root"; // substitua conforme seu ambiente
$password = "";     // substitua conforme seu ambiente
$dbname = "loja_online";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro de conexão com o banco de dados."]);
    exit();
}

// Consulta os produtos
$sql = "SELECT id, nome, preco, descricao, imagem FROM produtos ORDER BY id DESC";
$result = $conn->query($sql);

$produtos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}

$conn->close();

// Retorna os produtos em formato JSON
echo json_encode($produtos);
?>
