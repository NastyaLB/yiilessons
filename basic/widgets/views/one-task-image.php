<?php

use yii\helpers\Html;
//../upload/files/small/Lesson_2__Task_1___1.jpg
echo'<div class="thumb-images">';
foreach($link as $linkOne) {
    echo "<img src={$linkOne}>";
}
echo'</div>';