<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region_group".
 *
 * @property integer $id
 * @property string $name_group
 *
 * @property FootballTeam[] $footballTeams
 */
class RegionGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_group'], 'required'],
            [['name_group'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_group' => 'Name Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFootballTeams()
    {
        return $this->hasMany(FootballTeam::className(), ['id_group' => 'id']);
    }
}
