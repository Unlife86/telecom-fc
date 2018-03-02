<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\CbpGridGalleryAsset;

CbpGridGalleryAsset::register($this);

$this->title = 'Медиа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="grid-gallery" class="grid-gallery">

    <p><?= Html::a('Загрузить', ['upload'], ['class' => 'btn btn-success']) ?></p>

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
