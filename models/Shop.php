<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * Description of shop
 *
 * @property integer $id  - primary key
 * @property string $name - shop name
 * @property json $week_schedule_settings - default schedule during the week
 * @property date $update_date 
 * @property date $create_date 
 */
class Shop extends ActiveRecord {

    public static function tableName() {
        return 'shop';
    }

    public function behaviors() {
        $ret = [];

        $ret['timestamp'] = [
            'class' => \yii\behaviors\TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['create_date', 'update_date'],
                ActiveRecord::EVENT_BEFORE_UPDATE => 'update_date',
            ],
            'value' => function() {
                return date('Y-m-d H:i:s');
            },
        ];

        return $ret;
    }

    public function rules() {
        $ret = [
            [['id'], 'integer'],
            [['name', 'week_schedule_settings'], 'string'],
            [['name', 'week_schedule_settings'], 'required'],
            [['name'], 'unique'],
            [['update_date', 'create_date'], 'date', 'format' => 'php:Y-m-d H:i:s']
        ];


        return $ret;
    }

}
