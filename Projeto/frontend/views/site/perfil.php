<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Perfil';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Utilizador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .profile-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Perfil do Utilizador</h2>
    <img src="images/pessoa-icon.png" alt="Produto 1">
    <p><strong>Nome:</strong> <span id="nome">John Doe</span></p>
    <p><strong>NIF:</strong> <span id="nif">123456789</span></p>
    <p><strong>Email:</strong> <span id="email">john.doe@example.com</span></p>
    <p><strong>Morada:</strong> <span id="morada">Rua Exemplo, 123</span></p>
    <p><strong>Tlm:</strong> <span id="tlm">987654321</span></p>
    <button onclick="editarDados()">Editar Dados</button>
</div>

<script>
    function editarDados() {
        // Implementar a lógica de edição dos dados aqui
        alert("Botão de editar clicado. Implemente a lógica de edição.");
    }
</script>

</body>
</html>
