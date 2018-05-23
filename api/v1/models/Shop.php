<?php

namespace app\api\v1\models;

use app\models\Shop as BaseModel;

class Shop extends BaseModel {

    public function setterRules(){
        return [
            [['name'], 'strtolower'],
            [['name'], 'trim'],
            [['create_date', 'update_date'], 'oldValue', 'formatTo' => 'Y-m-d H:i:s']
        ];
    }

    public function fields() {
        $fields = parent::fields();
        foreach ($fields as $field_key => $value) {
            if (preg_match("/_date$/", $field_key)) {
                $fields[$field_key] = function() use ($field_key) {
                    $date = new \DateTime($this[$field_key]);
                    return $date->format('c');
                };
            }
        }
        return $fields;
    }

    public function load($data, $formName = null) {
        
        $formData = (isset($data[$formName])) ? $data[$formName] : $data;
        
        
        
        $loader = new \app\api\v1\components\Loader($this);
        $loader->load($formData);

    }
    
    
}
