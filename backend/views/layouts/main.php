<?php
use yii\helpers\Html;
use dmstr\widgets\Menu;

$this->beginContent('@common/views/layouts/base.php', [
    'bodyClass' => 'hold-transition skin-blue sidebar-mini',
    'wrapperParams' => [
        'class' => 'wrapper'
    ]
]); ?>
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form>
            <?= Menu::widget([]) ?>
            </section>
        </aside>
        <?= $this->render('content.php', ['content' => $content,]) ?>
    </div>
<?php $this->endContent(); ?>
