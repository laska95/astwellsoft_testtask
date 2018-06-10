<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\rules_filter;

/**
 * Description of Number
 *
 * @author laska
 */
class NumberRule extends BaseRule {

    public function getFieldRule() {
        $key = $this->nameAs ?? $this->attribute;
        return [$key => $this->getValue()];
    }

    public function getValue() {
//        $when = $this->when($this);
        $when = true;
        if ($when) {
            if ($this->isEmpty || $this->model[$this->attribute] !== null) {
                return floatval($this->model[$this->attribute]);
            }
        }
        return $this->model[$this->attribute];
    }

}
