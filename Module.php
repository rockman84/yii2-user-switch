<?php
namespace sky\userswitch;

use Yii;

class Module extends \yii\base\Module
{
    /**
     * grid columns attribute will show in index page
     * @var array
     */
    public $gridColumns = ['id', 'username', 'email'];
    
    /**
     * dataProvider configuration refer to \yii\data\ActiveDataProvider
     * @var array
     */
    public $dataProvider = [];
    
    /**
     * ip address will allow to access this module
     * @var array
     */
    public $ipAllow = ['::1', '127.0.0.1'];
    
    /**
     * for filter like attributes
     * @var array
     */
    public $likeAttributes = [];
    
    public function init() {
        parent::init();
        if (!YII_DEBUG || !in_array(Yii::$app->request->remoteIP, $this->ipAllow)) {
            throw new \yii\web\ForbiddenHttpException('forbidden access');
        }
    }
}