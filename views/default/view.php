<?php
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'User Details';
?>
<h3><?= $this->title ?></h3>
<?= DetailView::widget([
    'model' => $model
]) ?>

<?php if (!Yii::$app->user->isGuest && Yii::$app->user->id == $model->id) : ?>
    <p><?= Html::a('Logout', ['logout'], ['class' => 'btn btn-danger btn-sm']) ?></p>
<?php else : ?>
    <p><?= Html::a('Login', ['login', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?></p>
<?php endif; ?>
