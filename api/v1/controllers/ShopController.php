<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class ShopController extends ActiveController {

    public function behaviors() {
        $behaviors = parent::behaviors();

        $json = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors[] = $json;

        return $behaviors;
    }

    public $modelClass = '\app\api\v1\models\Shop';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
    ];

    public function actions() {
        $actions = parent::actions();

        $actions['create'] = [
            'class' => \yii\rest\CreateAction::class,
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'scenario' => $this->createScenario,
        ];
        
        // href = api/v1/shops/search
        $actions['search'] = [
            'class' => \app\api\v1\actions\SearchShopAction::class,
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'dataFilter' => [
                'class' => \yii\data\ActiveDataFilter::class,
                'searchModel' => \app\api\v1\models\Shop::class
            ]
        ];

        return $actions;
    }

}
