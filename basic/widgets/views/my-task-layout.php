<?php

echo "<style> .wraptasks { 
display: flex; justify-content: space-between;flex-wrap: wrap; }

.list-view { 
display: flex; justify-content: space-between;flex-wrap: wrap; }

.list-view > div:not:first-child { 
display: flex; justify-content: space-between;flex-wrap: wrap; }

.summary { width:100%; justify-content: start; }

.taskwidget { 
display:block; width:372px; box-shadow: 1px 1px 5px gray; padding: 0 5px; position: relative; color: #777777; margin-bottom:15px; }

.st1 { background-color: #4cae4c; } 

.st0 { background-color: #a94442; } 

.stN { background-color: #bbb; } 

.taskinwidget { 
width:100%; height: 100%; background-color:#fff; padding:5px; }

.taskinwidget > h4 { color:#333; margin:0 0 5px; padding:0; }

.taskinwidget > p { font-size:13px; color:#333; margin:0; padding:0; height:75px; overflow: hidden; }

.stN p { height:auto; }

.gogolink { display:block; width:100%; height: 100%; position:absolute; bottom:0; left:0 } </style>";