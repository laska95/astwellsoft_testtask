<?php

namespace app\models;

use \yii\db\ActiveRecord;

class DaySchedule extends ActiveRecord {

    const WEEK = [
        'MON' => 'mon',
        'TUE' => 'tue',
        'WED' => 'wed',
        'THU' => 'thu',
        'FRI' => 'fri',
        'SUT' => 'sut',
        'SUN' => 'sun'
    ];
    const DEF_OPEN_TIME = '08:00';
    const DEF_CLOSE_TIME = '18:00';

    public static function tableName() {
        return 'day_schedule';
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

    public function init() {
        $this->open_time = self::DEF_OPEN_TIME;
        $this->close_time = self::DEF_CLOSE_TIME;
        $ret = parent::init();
        return $ret;
    }

    public function rules() {
        $ret = [
            [['id', 'shop_id'], 'integer'],
            [['shop_id', 'day_date', 'open_time', 'close_time'], 'required'],
            [['day_date'], 'date', 'format' => 'php:Y-m-d'],
            [['open_time', 'close_time'], 'time', 'format' => 'php:H:i'],
            [['update_date', 'create_date'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['open_time'], 'default', 'value' => self::DEF_OPEN_TIME],
            [['close_time'], 'default', 'value' => self::DEF_CLOSE_TIME],
        ];
        
        return $ret;
    }
    
}
