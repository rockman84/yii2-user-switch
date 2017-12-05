<?php
namespace sky\userswitch\controllers;

use yii\data\ActiveDataProvider;
use Yii;
use yii\base\DynamicModel;

class DefaultController extends \yii\web\Controller
{
    public $layout = 'main';
    
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $userClass = Yii::$app->user->identityClass;
        $modelUser = Yii::createObject($userClass);
        $attributes = array_keys($modelUser->attributes);
        $query = $userClass::find();
        $filterModel = DynamicModel::validateData($attributes, [
            [$attributes, 'string']
        ]);
        if ($filterModel->load(Yii::$app->request->get())) {
            if ($likeAttrs = $this->module->likeAttributes) {
                foreach ($filterModel->getAttributes($likeAttrs) as $attribute => $value) {   
                    $query->andFilterWhere(['like', $attribute, $value]);
                }
            }
            if ($whereFilter = $filterModel->getAttributes(null, $likeAttrs ? $likeAttrs : [])) {
                $query->andFilterWhere($whereFilter);
            }
        }
        $dataProvider = Yii::createObject(array_merge(
            ['class' => ActiveDataProvider::className(), 'query' => $query],
            $this->module->dataProvider
        ));
        return $this->render('index', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel]);
    }
    
    public function actionView($id)
    {
        $user = $this->findUser($id);
        return $this->render('view', ['model' => $user]);
    }
    
    public function actionLogin($id)
    {
        $user = $this->findUser($id);
        Yii::$app->user->login($user);
        return $this->goHome();
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('index');
    }
    
    public function findUser($id)
    {
        $userClass = Yii::$app->user->identityClass;
        $user = $userClass::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('User not found.');
        }
        return $user;
    }
}
