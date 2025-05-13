<?php 
session_start();
require 'config/db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da Loja Online</title>
    <style>
        /* Reset de margem e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            background-color: #333;
            color: #fff;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #f4a261;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #f4a261;
            color: #333;
        }

        /* Conteúdo principal */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        /* Header */
        header h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.2rem;
            color: #666;
        }

        /* Seção de Estatísticas */
        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .stat {
            background-color: #fff;
            padding: 20px;
            width: 30%;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat h3 {
            font-size: 1.2rem;
            color: #333;
        }

        .stat p {
            font-size: 1.5rem;
            color: #2d9cdb;
        }

        /* Tabela de Pedidos Recentes */
        .recent-orders {
            margin-top: 50px;
        }

        .recent-orders h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4a261;
            color: #fff;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
        }

        .status.delivered {
            background-color: #2d9cdb;
        }

        .status.pending {
            background-color: #f4a261;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding: 15px;
            }

            .main-content {
                margin-left: 200px;
                padding: 15px;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }

            .stat {
                width: 80%;
                margin-bottom: 20px;
            }
        }

    </style>

</head>
<body>
    <div class="sidebar">
        <h2>Loja Online</h2>
        <ul>
            <li><a href="home.php" class="<?php echo ($current_page == 'home.php') ? 'active' : ''; ?>">Início</a></li>
            <li><a href="produtos.php" class="<?php echo ($current_page == 'produtos.php') ? 'active' : ''; ?>">Produtos</a></li>
            <li><a href="pedidos.php" class="<?php echo ($current_page == 'pedidos.php') ? 'active' : ''; ?>">Pedidos</a></li>
            <li><a href="clientes.php" class="<?php echo ($current_page == 'clientes.php') ? 'active' : ''; ?>">Clientes</a></li>
            <li><a href="relatorios.php" class="<?php echo ($current_page == 'relatorios.php') ? 'active' : ''; ?>">Relatórios</a></li>
            <li><a href="configuracoes.php" class="<?php echo ($current_page == 'configuracoes.php') ? 'active' : ''; ?>">Configurações</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h1>JOD_VENDAS</h1>
            <p>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</p>
        </header>
        
        <section class="stats">
            <div class="stat">
                <h3>Total de Vendas</h3>
                <p>R$ 20.000,00</p>
            </div>
            <div class="stat">
                <h3>Total de Pedidos</h3>
                <p>150</p>
            </div>
            <div class="stat">
                <h3>Total de Produtos</h3>
                <p>500</p>
            </div>
        </section>
        
        <section class="recent-orders">
            <h2>Últimos Pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>João Silva</td>
                        <td>2025-04-25</td>
                        <td><span class="status delivered">Entregue</span></td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>Ana Oliveira</td>
                        <td>2025-04-26</td>
                        <td><span class="status pending">Pendente</span></td>
                    </tr>
                    <!-- Adicione mais pedidos aqui -->
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
