<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

if ($exception instanceof \yii\web\ForbiddenHttpException) {
	$name = 'Access denied';
	$message = "You don't have permission to perform this action.";
}
elseif ($exception instanceof \yii\web\NotFoundHttpException) {
	$name = 'Page not found';
	$message = 'The requested resource was not found.';
}

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Return', 'javascript:history.back()', ['class' => 'btn btn-default']) ?>
        <br /><br />Please contact the system administrator if you need tech support.
    </p>

</div>
