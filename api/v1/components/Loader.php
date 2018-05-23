<?php

namespace app\api\v1\components;

class Loader {

    private $_model;

    public function __construct(&$model) {
        $this->_model = $model;
    }

    public function getModel() {
        return $this->_model;
    }

    public function load($formData) {
        foreach ($formData as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }
    }

    public function setAttribute($attribute, $value) {

        $rules = $this->_model->setterRules();
        foreach ($rules as $arr) {
            $up = is_array($arr[0]) ? (in_array($attribute, $arr[0]) ? TRUE : FALSE) : ($arr[0] === $attribute ? TRUE : FALSE);

            if ($up) {
                $filterName = $arr[1];
                unset($arr[0]);
                unset($arr[1]);
                $value = $this->filter($filterName, $attribute, $value, $arr);
            }
        }
        
        $this->_model->setAttribute($attribute, $value);
    }

    protected function filter($name, $attr, $value, $params) {
        switch ($name) {
            case 'strtolower':
                return strtolower($value);
            case 'trim':
                return trim($value);
            case 'oldValue':
                return $this->oldValue($attr);
            case 'datetime':
                return $this->parseDateTime($value, $params);
            case 'function':
                $fname = $params['function'];
                return $this->_model->{$fname};
        }
        
        throw new Exception('Unknown filter');
    }

    protected function oldValue($attr) {
        return $this->_model[$attr];
    }

    protected function parseDateTime($value, $params){
        $formatFrom = $params['formatFrom'] ?? NULL;
        $formatTo = $params['formatTo']; //requred
        
        $date = $formatFrom ? new \DateTime($value, $formatFrom) :  new \DateTime($value);
        return $date->format($formatTo);
    }
}
