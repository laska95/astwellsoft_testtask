<?php

use yii\db\Migration;

/**
 * Class m180519_221639_init
 */
class m180519_221639_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'week_schedule_settings' => $this->json(),
            'update_date' => $this->dateTime(),
            'create_date' => $this->dateTime()
        ]);
        
        $this->createTable('day_schedule', [
            'id' => $this->primaryKey(),
            'day_date' => $this->date()->notNull(),
            'shop_id' => $this->integer()->notNull(),
            'open_time' => $this->time(),
            'close_time' => $this->time(),
            'update_date' => $this->dateTime(),
            'create_date' => $this->dateTime()
        ]);
                
        $this->addForeignKey('fk-shop-to-day_schedule', 
                'day_schedule', 'shop_id', 
                'shop', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-shop-to-work_schedule', 'day_schedule');
        $this->dropTable('day_schedule');
        $this->dropTable('shop');
    }
  
}
