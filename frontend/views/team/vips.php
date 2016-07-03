<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$this->title = 'Руководство клуба'
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">Руководство</h1>
    <ul class="breadcrumb">
        <li><a href="#">Главная</a></li>
        <li>Руководство клуба</li>
    </ul>
</header>
<div class="subsection bg-white"><div class="row">
        <div class="col-lg-12">
            <table class="table list-item">
                <tbody>
                <tr class="bg-grey">
                    <td class="col-lg-3 bg-blue content-box">
                        <div class="wrap-img">
                            <img src="img/team/player.png" class="img-responsive img-modal" data-toggle ='modal' data-target = '#imgModal' alt="member team">
                        </div>
                    </td>
                    <td class="col-lg-4"><p class="text-uppercase">Шамин</p>Сергей Александрович</td>
                    <td class="col-lg-5"><p class="text-uppercase">Учередитель клуба</p></td>
                </tr>
                <tr class="bg-grey">
                    <td class="col-lg-3 bg-blue content-box">
                        <div class="wrap-img">
                            <img src="img/team/player.png" class="img-responsive img-modal" data-toggle ='modal' data-target = '#imgModal' alt="member team">
                        </div>
                    </td>
                    <td class="col-lg-4"><p class="text-uppercase">Сидоров</p>Иван Петрович</td>
                    <td class="col-lg-5"><p class="text-uppercase">тренер</p></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div></div>