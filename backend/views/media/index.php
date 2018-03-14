<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\CbpGridGalleryAsset;
use yii\bootstrap\Modal;

CbpGridGalleryAsset::register($this);

$this->title = 'Медиа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="grid-gallery" class="grid-gallery">

    <?php
        Modal::begin([
            'id' => 'modalAjax',
            'header' => false,
            'toggleButton' => [
                'id' => 'modalButton',
                'label' => 'Загрузить',
                'class'=>'btn btn-success',
                'value' => Url::to('index.php?r=media%2Fupload')
            ],
        ]);
        echo '<i class="fa fa-spinner fa-spin" style="font-size:36px"></i>';
        Modal::end()
    ?>

    <section class="grid-wrap">
        <ul class="grid">
            <li class="grid-sizer"></li>
            <?php foreach ($media_files as $file):
                echo Html::tag('li',Html::tag('figure',Html::img($file)));
            endforeach; ?>
        </ul>
    </section>
    
    <section class="slideshow">
		<ul>
			<li>
				<figure>
					<figcaption>
						<h3>Letterpress asymmetrical</h3>
						<p>Kale chips lomo biodiesel stumptown Godard Tumblr, mustache sriracha tattooed cray aute slow-carb placeat delectus. Letterpress asymmetrical fanny pack art party est pour-over skateboard anim quis, ullamco craft beer.</p>
					</figcaption>
					<?php foreach ($media_files as $file):
                        echo Html::tag('li',Html::tag('figure',Html::img($file)));
                    endforeach; ?>
				</figure>
            </li>
        </ul>
        <nav>
			<span class="icon nav-prev"></span>
			<span class="icon nav-next"></span>
			<span class="icon nav-close"></span>
		</nav>
		<div class="info-keys icon">Navigate with arrow keys</div>
    </section>

<?php
$script = <<< JS
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
JS;
$this->registerJs($script); ?>

</div>
