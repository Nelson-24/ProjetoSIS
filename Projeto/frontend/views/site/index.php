<?php

use yii\helpers\Html;

$this->title = 'CRM';

/** @var \common\models\Artigos $artigos */

/** @var \common\models\Categoria $categorias */


$artigo23 = \common\models\Artigos::findOne(23);
$artigo24 = \common\models\Artigos::findOne(24);
$artigo25 = \common\models\Artigos::findOne(25);
$artigo26 = \common\models\Artigos::findOne(26);
$artigo27 = \common\models\Artigos::findOne(27);
$artigo28 = \common\models\Artigos::findOne(28);
$artigo29 = \common\models\Artigos::findOne(29);
$artigo30 = \common\models\Artigos::findOne(30);
$artigo31 = \common\models\Artigos::findOne(31);

?>
<!DOCTYPE html>
<html lang="pt-pt">

<body>
<div class="banner_bg_main">
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><a href="index.php"><img src="images/logotipo-loja.png" width="150" height="0"></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section end -->
    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <div class="containt_main">

                <div class="main">
                    <!-- Another variation with a button -->
                    <div class="input-group">

                        <div class="input-group-append">


                            </button>
                        </div>
                    </div>
                </div>






            </div>
        </div>
    </div>
    <!-- header section end -->
    <!-- banner section start -->
    <div class="banner_section layout_padding">

    </div>
</div>
<!-- banner section end -->

<!-- banner bg main end -->
<!-- fashion section start -->
<div class="fashion_section">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <h1 class="fashion_taital">Tijolos</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo23->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo23->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo23->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo23->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo24->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo24->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo24->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo24->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo25->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo25->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo25->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo25->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <h1 class="fashion_taital">Blocos</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo26->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo26->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo26->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo26->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo27->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo27->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo27->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo27->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo28->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo28->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo28->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo28->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <h1 class="fashion_taital">Telhas</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo29->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo29->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo29->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo29->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo30->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo30->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo30->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo30->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?= $artigo31->descricao ?></h4>
                                    <p class="price_text">Preço <span style="color: #262626;"><?= $artigo31->preco ?>€</span></p>
                                    <div class="tshirt_img"><img src="images/materiais/<?= $artigo31->imagem ?>"></div>
                                    <div class="btn_main">
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo31->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                                        <?php else: ?>
                                            <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <div class="seemore_bt"><a href="#">Detalhes</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!-- fashion section end -->
<!-- electronic section start -->

<a class="carousel-control-prev" href="#jewellery_main_slider" role="button" data-slide="prev">
    <i class="fa fa-angle-left"></i>
</a>
<a class="carousel-control-next" href="#jewellery_main_slider" role="button" data-slide="next">
    <i class="fa fa-angle-right"></i>
</a>

</div>
</div>
<!-- jewellery  section end -->
</body>