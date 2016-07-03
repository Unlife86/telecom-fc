<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "league".
 *
 * @property integer $id
 * @property integer $current
 * @property string $name
 * @property string $type
 *
 * @property Matches[] $matches
 * @property Tournament[] $tournaments
 */
class League extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'league';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Íàèìåíîâàíèå',
            'type' => 'Òèï',
            'current' => 'Ñòàòóñ'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['id_league' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['id_league' => 'id']);
    }
}
