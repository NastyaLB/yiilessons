<?php
/** @var  \app\models\Lesson $model */

$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'description')->textarea();
echo $form->field($model, 'order')->textInput(['type' => 'number']);
echo \yii\helpers\Html::submitButton('Send', ['class' => 'btn btn-success']);
\yii\widgets\ActiveForm::end();


