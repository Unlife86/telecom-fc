<?php

namespace backend\models;


use common\models\Matches;
use kartik\date\DatePicker;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class MatchesSearch extends Matches
{
   private $_output; 
    
   private function _fullScore()
    {
        if (is_null($this->score_h)) {
            return '-:-';
        } else {
            if (is_null($this->date_match)) { 
                return ($this->score_h > $this->score_g ? '+ : -' : '- : +').' ('.$this->score_h .' : '. $this->score_g.') ';
            } else {
                return $this->score_h .' : '. $this->score_g;
            }                                        
        } 
    }
    private function _dateFormat()
    {
        if (!is_null($this->date_match)) {
            $format = (Yii::$app->formatter->asDate($this->date_match,'php:H:i') === '00:00' ? 'php:d M' : 'php:d M H:i');
            return Yii::$app->formatter->asDate($this->date_match, $format);
        }
        return $this->date_match;        
    }
    private function _tourLabel()
    {
        $_labels = [
            '2' => [
                '2' => ['1/8 финала', '1/4 финала', 'Полуфинал', 'Полуфинал: Ответные матчи', 'Финал'],
                '3' => ['1/4 финала', 'Полуфинал', 'Полуфинал: Ответные матчи', 'Финал'],
            ],
            '4' => [
                '2' => ['Полуфинал', 'за 3 место', 'Финал'],
                '3' => ['Полуфинал', 'за 3 место', 'Финал'],
            ],
        ];

        return !array_key_exists($this->id_league, $_labels) ? $this->n_tour : $_labels[$this->id_league][$this->id_season][$this->n_tour - 1];
    }

    public function rules()
    {
        return [
            [['id', 'id_season', 'n_tour', 'id_home', 'id_guest', 'score_h', 'score_g', 'id_league', 'id_stadium'], 'integer'],
            [['date_match'], 'safe'],
        ];
    }    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = static::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_season' => SORT_ASC,
                    'n_tour' => SORT_ASC,
                    'id' => SORT_ASC,
                ],
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_season'=>$this->id_season,
            'n_tour' => $this->n_tour,
            'id_home' => $this->id_home,
            'id_guest' => $this->id_guest,
            'id_league' => in_array($this->id_league, [3,4]) ? [3,4] : $this->id_league,
        ]);

        $query->andFilterWhere(['like', 'date_match', $this->date_match]);

        return $dataProvider;
    }
    public function columns()
    {
        $columns = [ 
            [
                'attribute' => 'id_league',
                'filter' => ArrayHelper::map($this->leagues,'id','name'),
                'value' => 'idLeague.name',                
            ],     
            [
                'attribute' => 'id_season',
                'filter' => ArrayHelper::map($this->seasons,'id_season','idSeason.year'),
                'value' => 'idSeason.year',
            ],     
            [
                'attribute' => 'n_tour',
                'filter' => true,
                'value' => function($model) {
                    return $model->_tourLabel();
                },
            ],
            [
                'class' => '\kartik\grid\EditableColumn',
                'attribute'=>'date_match',
                'filterType' => '\kartik\datetime\DateTimePicker',
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'startView' => 3,
                        'minView' => 3,
                        'format' => 'yyyy-mm',
                        'autoclose' => true,
                    ]
                ],
                'editableOptions' => [
                    'preHeader' => false,
                    'inputType' => '\kartik\datetime\DateTimePicker',
                    'options' => [
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]
                ],  
                'value' => function($model) {
                    return $model->_dateFormat();
                },           
            ],
            [
                'attribute'=>'id_stadium',
                'filter' => false,
                'value'=>'idStadium.name',
            ],
            [
                'attribute'=>'id_home',
                'filter' => false,
                'value'=>'idHome.name_team',
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'score_h',
                'filter' => false,
                'label' => 'Счет',
                'editableOptions' => function ($model, $key, $index) {
                    return [
                        'header' => 'Счет',
                        'preHeader' => false,
                        'afterInput' => function ($form, $widget) use ($model, $index) {
                            return $form->field($model, "[{$index}]score_g")->label(false);
                        },
                        'options' => [
                            'size' => 'md',
                            'pluginOptions' => [
                                'autoclose'=>true
                            ]
                        ]
                    ];
                },
                'value' => function($model) {
                    return $model->_fullScore();
                },
            ],
            [
                'attribute'=>'id_guest',
                'filter' => false,
                'value'=>'idGuest.name_team',
            ],
            [           
                'class'=>'kartik\grid\BooleanColumn',
                'label'=>'Статус',
                'value' => function($model) {
                    return ((!is_null($model->score_h) && is_null($model->date_match)) ? 0 : 1);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];

        if (in_array($this->id_league, [3,4])) {
            array_unshift($columns, [
                'attribute' => 'id_league',
                'value' => 'idLeague.type',
                'group' => true,
                'groupedRow' => true,
            ]);
        }

        return $columns;
    }
    public function toolbarContent()
    {
        return Html::a(Html::tag('i', null, ['class' => 'glyphicon glyphicon-plus']).Html::tag('strong', 'Матч', []), ['create', $this->formName() => [
                    'id_league' => $this->id_league,
                    'id_season' => $this->id_season,
                    'n_tour' => $this->n_tour,
                ]], ['class' => 'btn btn-success']);   
    }

    public function setOutput($changedAttributes)
    {
        $this->load($changedAttributes, '');
        $att = $this->attributes;
        if (array_key_exists('date_match', $changedAttributes)) {
            $this->_output = $this->_dateFormat();
        } elseif (array_key_exists('score_h', $changedAttributes) || array_key_exists('score_g', $changedAttributes)) {
            $this->_output = $this->_fullScore();
        }
        return $this->_output;
    }
    public function getOutput()
    {
        return $this->_output;
    }

    public function getIdGuest()
    {
        return is_null($this->id_guest) ? '' : $this->hasOne(FootballTeamSearch::className(), ['id_team' => 'id_guest'])->from(FootballTeamSearch::tableName() . ' g');
    }
    public function getIdHome()
    {
        return is_null($this->id_home) ? '' : $this->hasOne(FootballTeamSearch::className(), ['id_team' => 'id_home'])->from(FootballTeamSearch::tableName() . ' h');
    }
}
