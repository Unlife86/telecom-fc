<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Matches;
use yii\data\ActiveDataProvider;

class MatchWidget extends Widget
{
    public $position = 'middle'; // 'aside'

    public $type = 'both'; // 'lastPlayed' || 'nextWillPlay'

    public $styleTag = [];

    public $clock = false;

    public $filterParams = [
        'id' => null,
        'team_id' => 8,
        'league_id' => null,
        'season_id' => null,
    ];

    private $_header = [
        'nextWillPlay' => 'Следующий матч',
        'lastPlayed' => 'Последний результат',
    ];

    private $_model = null;

    /**
     * Setting _model
     */

    public function setModel($_model = null)
    {        
        $this->_model = $_model === null ? $this->_findModel() : $_model;
    }

    private function _initialFilter()
    {
        extract($this->filterParams, EXTR_OVERWRITE);
        return Matches::find()->filterWhere(['id_season' => $season_id, 'id_league' => $league_id])->andFilterWhere(['or',['=', 'id_guest', $team_id], ['=', 'id_home', $team_id]]);
    }

    private function _nextWillPlayMatchFilter()
    {
        return $this->_initialFilter()->andWhere(['not',['date_match' => null]])->andWhere(['score_h' => null, 'score_g' => null])->orderBy(['date_match' => SORT_ASC])->one();
    }

    private function _lastPlayedMatchFilter()
    {
        return $this->_initialFilter()->andWhere(['not',['score_h' => null, 'score_g' => null]])->orderBy(['date_match' => SORT_DESC])->one();
    }

    private function _findModel()
    {
        if (isset($this->filterParams['id']) && $this->filterParams['id'] !== null) {
            $_model = Matches::findOne($this->filterParams['id']);
        } elseif ($this->type === 'both') {
            $_model = $this->_nextWillPlayMatchFilter();                
            if ($_model === null) {
                $_model = $this->_lastPlayedMatchFilter();
            }
        } else {
            $method = '_'.$this->type.'MatchFilter';
            $_model = $this->$method();
        }
        return $_model;
    }

    /**
     * End block setting _model
     */

    /**
     * Configurable render() params
     */

    private function _nextMatchDate()
    {
        if (!$this->clock || $this->type === 'lastPlayed') {return [];}
        $date = new \DateTime($this->_model->date_match);
        $date = date_modify($date, '-1 month');
        $date = Yii::$app->formatter->asDate($date, 'php:Y,n,d,H,i,s');
        return ['js' => "$(function () { var newYear = new Date($date); $('#clock').countdown({until: newYear});});"];
    }

    private function _styleTag()
    {
        if (!$this->styleTag) {return [];}
        $result = '';
        foreach ($css = $this->styleTag as $class => $value) {
            $style = Html::cssStyleFromArray($value);
            $result .= ".$class { $style } ";
        }
        return ['style' => $result === '' ? null : rtrim($result)];
    }

    /**
     * End configurable render() params
     */

    private function _formatDateMatchAside() {       
        return 'php:d F в H:i';
    }

    private function _formatDateMatchMiddle() {        
        return 'php:j F, Y | H:i';
    }
    
    public function init()
    {
        parent::init();
        $this->position = ucfirst(strtolower($this->position));
        $this->setModel();
    }

    public function __construct($config = [])
    {
        foreach (['styleTag', 'filterParams'] as $property) {
            if (isset($config[$property])) {
                $config[$property] = array_merge($this->$property, $config[$property]);
            }
        }
        parent::__construct($config);
    }

    public function run()
    {
        if ($this->_model === null) {
        } else {

            if ($this->type === 'both') {
                $this->type = $this->_model->score_h === null ? 'nextWillPlay' : 'lastPlayed';
            }
            $_params = array_merge(['model' => null, 'header' => $this->_header[$this->type]], $this->_nextMatchDate(), $this->_styleTag());
            
            $_method = '_formatDateMatch'.$this->position;
            if (Yii::$app->formatter->asDate($this->_model->date_match, 'php:H') == '00') {
                $this->_model->date_match = Yii::$app->formatter->asDate($this->_model->date_match, 'php:d F');
            } else {
                $this->_model->date_match = Yii::$app->formatter->asDate($this->_model->date_match, $this->$_method());
            }

            if ($this->position == 'Aside') {
                $_dataProvider = new ActiveDataProvider([
                    'pagination' => false,
                ]);
                $_dataProvider->setModels([$this->_model]);
                $_params['model'] = $_dataProvider;
            } else {
                $_params['model'] = $this->_model;
            }

            return $this->render('match-widget/'.$this->type.$this->position, $_params);
        }
    }
}

?>