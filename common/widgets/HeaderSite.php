<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;

class HeaderSite extends Widget
{
    public $menuItems;

    private $options = [
        'linkOptions' => ['class' => 'text-uppercase black-text'],
    ];

    /*private function _leagues()
    {
             
        $leagues = Yii::$app->currentFootballData->getListLeague();
        $menuItems = [];

        foreach($leagues as $league):

            $season =  Yii::$app->currentFootballData->getCurrentSeason($league->id);
            $tour = Yii::$app->currentFootballData->getCurrentTour($season, $league->id);

            if ($league->current == 1) { $this->_currentFootballData = ['id_league' => $league->id, 'id_season' => $season, 'n_tour' => $tour]; }

            if (($league->id == 3)) {
                if ($league->current == 1) {
                    array_push($menuItems,[
                        'label' => $league->name,
                        'url' => ['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season],
                    ]);
                }
            } else {
                array_push($menuItems,[
                    'label' => $league->name,
                    'url' => ['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season],
                ]);
            }

        endforeach;

        return $menuItems;
    }*/

    private function _createItem($property, $url = ['#'])
    {
        if (empty($property) || is_numeric($property) || is_bool($property)) { return []; }

        if (is_string($property)) {
            return [['label' => $property, 'url' => $url, 'linkOptions' => $this->options['linkOptions']]]; 
        }

        if (ArrayHelper::isIndexed($property)) {
            foreach($property as $key => $item):
                $property[$key] = array_merge($item, $this->options);
            endforeach;
        } else {
            $property = [array_merge($property, $this->options)];
        }

        return $property;
    }

    private function _items()
    {
        /*return ArrayHelper::merge(
            ArrayHelper::merge(
                ArrayHelper::merge(
                    $this->_createItem($this->menuItems), 
                    $this->_createItem($this->_leagues())
                ), 
                $this->_createItem($this->footballsFederations)
            ),
            $this->_createItem($this->backendLink, 'http://backend.telecom-fc.ru'.Url::to(['matches/index', 'MatchesSearch' => $this->_currentFootballData]))
        );*/

        return array_filter($this->_createItem($this->menuItems));
        
    }

    public function renderNav()
    {     
        return NavBar::begin([
            'screenReaderToggleText' => 'Меню сайта',
            'innerContainerOptions' => ['class' => 'row bg-white',],
            'options' => [
                'class' => 'col-xs-12 general reset-margin',
            ],
        ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $this->_items(),
                'dropDownCaret' => '',
                'activateParents'=> true,
            ]);
        NavBar::end();
    }

    public function run()
    {
        return $this->render('header-site/header', [
            'nav' => $this->renderNav(),
        ]);
    }
}

?>