<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><a href='<?=Url::to(['site/login'])?>'>Login</a> / <?= Html::encode($this->title) ?></h1>
    
    <p><?=$model->messageTOuser?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'confirm')->passwordInput() ?>
        
        <?= $form->field($model, 'name')->textInput() ?>
        
        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Registrate', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
