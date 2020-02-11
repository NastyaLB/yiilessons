<?php

use yii\helpers\Html;
echo'<div class="thumb-images">';
foreach($link as $linkOne) {
    echo "<img src={$linkOne}>";
}
echo'</div>';