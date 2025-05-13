
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #2980b9;
        }

        .mensagem {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        p a {
            color: #3498db;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if (isset($_GET['sucesso'])) {
        echo "<div class='mensagem sucesso'>Conta criada com sucesso! Faça login.</div>";
    }

    if (isset($_GET['erro'])) {
        if ($_GET['erro'] == 'senha') {
            echo "<div class='mensagem erro'>Senha incorreta.</div>";
        } elseif ($_GET['erro'] == 'email') {
            echo "<div class='mensagem erro'>Email não encontrado.</div>";
        }
    }
    ?>

    <h2>Login</h2>

    <form action="process_login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        Não tem conta? <a href="register.php">Criar conta</a>
    </p>
</div>

</body>
</html>
