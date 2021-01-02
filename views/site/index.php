<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Demo App';
?>
<div class="site-index">
    <div class="alert alert-info" role="alert" style="text-align: center;"><b>This is a demo version.</b> Data is fictitious and functionality is limited.</div>
    <div class="jumbotron">
        <h1>Welcome!</h1>
        <p class="lead">Navigate using the top menu.<br />Feel free to change any data you like on this demo version.</p>
        <p><?= Html::a('Start browsing', ['/inventory'], ['class'=>'btn btn-lg btn-success']) ?> <?= Html::a('View code', 'https://github.com/ricmz', ['class'=>'btn btn-lg btn-info']) ?></p>
    </div>

</div>
