<?php 

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<header class="row general">
    <div class="header-content">
        <div id="logo" class="col-xs-2 bg-image-default" style="background-image: url(../img/logo-telecom.png); background-size: contain;"></div>
        <div class="col-xs-9 header-text">
            <p class="bold">ОФИЦИАЛЬНЫЙ САЙТ</p>
            <p>Футбольного клуба «Телеком»</p>
        </div>
    </div>
    <?php 
    NavBar::begin([]);
        echo Nav::widget([]);
    NavBar::end(); 
    ?>
</header>