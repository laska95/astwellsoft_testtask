<?php

/*
 * Описує правила, за якими генерується масив, що повертається методом field
 * fields() моделей 
 */

namespace app\components;

/**
 * 
 *
 * @author laska
 */
class GetterRulesBehavior extends \yii\base\Behavior{
    
    public function getterRules(){
        return ['123123121'];
    }
    
    public function fields() {
        
        $rules = $this->owner->getterRules();
        
        $ret = [];
        
        foreach ($rules as $rule){
            $attr_list = $rule[0];
            if (is_string($attr_list)){
                $attr_list = [$attr_list];
            }
            
            if (isset($rule['class'])){
                $className = $rule['class'];
                unset($rule['class']);
            } else {
                $className = '\app\components\rules_filter\\' . ucwords($rule[1]) . 'Rule';
                unset($rule[1]);
            }
            
            $ruleModel = array_slice($rule, 1);
            $ruleModel['class'] = $className;
            $ruleModel['model'] = $this->owner;
            
            /** @var $ruleModel rules_filter\BaseRule  */
            $ruleModel = \Yii::createObject($ruleModel);
            
            foreach ($attr_list as $attr_name){
                $ruleModel->attribute = $attr_name;
                $ret = array_merge($ret, $ruleModel->getFieldRule());
            }
            
//            var_dump($ret);
//            die;
        }
        
        return $ret;
    }
}
