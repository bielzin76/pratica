
<?php
// Conecta ao banco de dados usando MySQLi
$host = 'localhost'; // Servidor (normalmente localhost)
$user = 'root';      // Usuário do MySQL
$pass = '';          // Senha (em localhost, normalmente vazia)
$db = 'login_tutorial'; // Nome do banco de dados

$conn = new mysqli($host, $user, $pass, $db); // Cria conexão

if ($conn->connect_error) { // Verifica se houve erro
    die("Falha na conexão: " . $conn->connect_error); // Exibe erro e para tudo
}
?>
