<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Carrinho';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f8f8;
            color: #333;
        }

        .invoice {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        .product {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product img {
            max-width: 80px;
            height: auto;
            margin-right: 10px;
        }

        .product-details {
            flex-grow: 1;
        }

        .cart {
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 20px;
        }

        .cart p {
            text-align: right;
            margin: 0;
        }

        .total {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="invoice">
    <div class="header">
        <h1>Fatura de Compra</h1>
    </div>

    <div class="product">
        <img src="images/materiais/cimento.jpg" alt="Produto 1">
        <div class="product-details">
            <h2>Cimento</h2>
            <p>Saco de cimento de 25 Kg</p>
        </div>
        <p>25€</p>
    </div>

    <div class="product">
        <img src="images/materiais/tijolo-04.jpg" alt="Produto 2">
        <div class="product-details">
            <h2>Tijolo 04</h2>
            <p>Conjunto de 200 tijolos</p>
        </div>
        <p>20€</p>
    </div>

    <div class="cart">
        <p class="total">Total: 45€</p>
    </div>
</div>

</body>
</html>