<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Контакты';
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">Контакты</h1>
    <ul class="breadcrumb">
        <li><a href="#">Главная</a></li>
        <li>Контакты</li>
    </ul>
</header>
<div class="subsection bg-white">
    <h2 class="text-uppercase blue-text underline">стать спонсором</h2>
    <table>
        <tbody>
            <tr>
                <td class="col-xs-6">
                    <blockquote class="blockquote-reverse">
                        <p><!--Если Вы хотите принять активное участие в развитии индустрии мобильных игр, встретить новых партнеров и просто заявить о своей компании, м-->Мы готовы обсудить с Вами смелые идеи и уникальные варианты сотрудничества.</p>
                    </blockquote>
                </td>
                <td class="col-xs-6">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'form-horizontal']); ?>
                    <?= $form->field($model, 'name',['inputOptions' => ['placeholder' => 'Наименование организации или ФИО']])->label(false)->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email',['inputOptions' => ['placeholder' => 'Ваш электронный адрес']])->label(false) ?>
                    <?= $form->field($model, 'phone',['inputOptions' => ['placeholder' => 'Ваш номер телефона']])->label(false) ?>

                </td>
            </tr>
            <tr>
                <td colspan="2"">
                    <div class="col-xs-offset-6">
                        <?= $form->field($model, 'verifyCode')->label(false)->widget(Captcha::className(), [
                            'template' => '<div class="col-xs-4">{image}</div><div class="col-xs-8">{input}</div>',
                        ]) ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <div class="col-xs-offset-6 text-center">
                            <?= Html::submitButton('отправить', ['class' => 'btn btn-primary btn-lg text-uppercase', 'name' => 'contact-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </td>
            </tr>
        </tbody>
    </table>
<!--</div>
<div class="subsection bg-white">-->
    <h2 class="text-uppercase blue-text underline">Стать абонентом</h2>
    <table>
        <tbody>
        <tr >
            <td rowspan="2" class="col-lg-6">
                <blockquote class="blockquote-reverse">
                    <p>Кино, музыка, спорт, увлечения и многое другое в цифровом качестве.</p>
                </blockquote>
                <blockquote class="blockquote-reverse">
                    <p>Последние новости, социальные сети и многое другое благодаря интернету по доступным ценам.</p>
                </blockquote>
            </td>
            <td class="col-lg-6 text-left">
                <h3 class="text-uppercase">Офис "в Микрорайоне"</h3>
                <address>Адрес: пр-т Текстильщиков, дом 11/1</address>
                <p>Телефон: 3-60-00, 3-50-00</p>
            </td>
        </tr>
        <tr>
            <td class="col-lg-6 text-left">
                <h3 class="text-uppercase">Офис "на Спастанции"</h3>
                <address>Адрес: пр-т Ленина, дом 26</address>
                <p>Телефон: 3-33-30</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="col-lg-12">
                <footer class=" col-lg-offset-6 col-lg-6 text-center">
                    <a class="btn btn-primary btn-lg text-uppercase" href="http://lenkuz.ru/index.php/televidenie/" role="button">подключиться</a>
                </footer>
            </td>
        </tr>
        </tbody>
    </table>
</div>