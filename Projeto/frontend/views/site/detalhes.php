<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Detalhes';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Artigo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }

        .article-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        h2, p {
            margin-bottom: 10px;
        }

        .price {
            color: green;
            font-weight: bold;
            font-size: 1.2em;
        }

        .add-to-cart-btn {
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

<div class="article-container">
    <img src="images/materiais/cimento.jpg" alt="Imagem do Artigo 1">
    <h2>Cimento</h2>
    <p>Referência: 11111111</p>
    <p>Descrição: Saco de Cimento de 25 KG</p>
    <p>Stock: 10 unidades disponíveis</p>
    <p>Categoria: Cimentos</p>
    <p class = price>Preço: 25€</p>
    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">Adicionar ao Carrinho</button>
</div>

<script>
    function adicionarAoCarrinho() {
        alert("Artigo adicionado ao carrinho!");
    }
</script>

</body>
</html>