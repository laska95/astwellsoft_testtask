<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\rules_filter;

/**
 * Description of DateRule
 *
 * @author laska
 */
class DateTimeRule extends BaseRule{
    
    public $formatFrom;
    public $formatTo; //required


    public function getFieldRule() {
        $key = $this->nameAs ?? $this->attribute;
        $ruleObj = $this;
        return [$key => function () use ($ruleObj){return $ruleObj->getValue(); }];
    }

    public function getValue() {
//        $when = $this->when($this);
        $when = true;
        if ($when) {
            if ($this->isEmpty || $this->model[$this->attribute] !== null) {
                $date = $this->formatFrom 
                        ? \DateTime::createFromFormat($this->formatFrom, $this->model[$this->attribute]) 
                        : new \DateTime($this->model[$this->attribute]);
                return $date->format($this->formatTo);
            }
        }
        return $this->model[$this->attribute];
    }

}
