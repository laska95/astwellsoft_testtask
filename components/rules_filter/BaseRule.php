<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\rules_filter;

/**
 * Description of BaseRule
 *
 * @author laska
 */
abstract class BaseRule extends \yii\base\BaseObject{

    public $model;      //requred
    public $attribute;  //requred
    public $nameAs;     //def == $attribute
    
    public $if;     //scenario name
    public $when;   //function
    public $isEmpty;//bool - чи застосовувати приведення типів, якщо значення пусте

    public function init() {
//        $this->nameAs = $this->nameAs ? $this->nameAs : $this->attribute;
//        $this->when = $this->when ? $this->when : self::defWhenFnc($this);
        $this->isEmpty = $this->isEmpty ? $this->isEmpty : false; 
    }

    abstract public function getFieldRule();
       
    abstract public function getValue();

    public static function defWhenFnc(BaseRule $ruleObj){
        return true;
    }
    
}
