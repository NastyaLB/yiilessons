<?php

/* @var \app\models\TaskDesk $model */

$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model, 'title') -> textInput (['style'=>'background-color:#5cb85c;']);
echo $form->field($model, 'description') -> textarea(); 
echo $form->field($model, 'deadline') -> textInput(); 
echo $form->field($model, 'creator_id') -> textInput(); 
echo $form->field($model, 'responsible_id') -> textInput(); 

?> 
<style>
    .yiible {display: block; height: 34px; padding: 6px 12px; font-size: 20px; line-height: 2; color: #555555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;};
</style>
<label class="control-label">Дедлайн</label>
<input class="yiible taskdb-responsible_id" type="datetime-local">
<div class="help-block"></div>
<?

echo \yii\helpers\Html::submitButton('Send', ['class' => 'btn btn-success']);


\yii\widgets\ActiveForm::end();