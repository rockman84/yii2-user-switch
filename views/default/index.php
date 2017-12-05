<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\widgets\DetailView;

/* 
 * Copyright (C) 2017 Wong Hansen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/* @var $this \yii\web\View */

$this->title = 'User Switch';
?>

<h1>User Switch</h1>
<hr>
<h3>User Identity</h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => array_merge(Yii::$app->controller->module->gridColumns, [
        [
            'class' => ActionColumn::className(),
            'template' => '{login} {view}',
            'buttons' => [
                'login' => function ($url, $model) {
                    if (Yii::$app->user->id != $model->id) {
                        return Html::a('Login', $url, ['class' => 'btn btn-primary btn-sm']);
                    }
                }
            ],
        ]
    ]),
    
]) ?>

<?php if (!Yii::$app->user->isGuest) : ?>
    <h3>Current Logged</h3>
    <p><?= Html::a('Logout', ['logout'], ['class' => 'btn btn-danger btn-sm']) ?></p>
    <?= DetailView::widget([
        'model' => Yii::$app->user->identity,
        'attributes' => Yii::$app->controller->module->gridColumns
    ]) ?>
<?php endif; ?>