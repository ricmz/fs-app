<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?= \yii\helpers\Url::to('@web/favicon.png') ?>" type="image/png" />
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/images/logo_app.png', ['style' => 'vertical-align: middle']), //General::imagenGeneral('logo_app'),
                'brandUrl' => Yii::$app->homeUrl,
                'brandOptions' => ['style'=>'padding-top: 9px; padding-bottom: 0px;'], // Centrado vertical de imagen de 32px de alto en un contenedor de 50px de alto (clase navbar-brand).
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
                'renderInnerContainer'=>false, // false means 100% width navbar
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site'], 'visible'=>!Yii::$app->user->isGuest, 'active'=>$this->context->id=='site'],
                    ['label' => 'Inventory', 'url' => ['/inventory'], 'visible'=>!Yii::$app->user->isGuest, 'active'=>$this->context->module->id=='inventory'],
                    ['label' => 'Customers', 'url' => ['/cliente'], 'visible'=>!Yii::$app->user->isGuest, 'active'=>$this->context->id=='cliente'],
                    ['label' => 'Users', 'url' => ['/usuario'], 'visible'=>!Yii::$app->user->isGuest, 'active'=>$this->context->id=='usuario'],
                ]
            ]);

            // User menu:
            if (!Yii::$app->user->isGuest)
            {                
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right', 'style'=>'margin-right: 5px;'],
                    'encodeLabels'=>false,
                    'items' => [
                        ['label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.Yii::$app->user->identity->nombre, 'url' => '#', 'items'=>[
                                ['label' => '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> My Account', 'url' => ['/usuario/mi-cuenta']],
                                ['label' => '', 'url' => '#', 'options'=>['class'=>'divider']],
                                ['label' => '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                            ]
                        ],
                    ]
                ]);                
            }

            NavBar::end();

        ?>

        <?= $content ?>

    </div>

    <footer class="footer">
        <div class="container-fluid">
            <p class="pull-left">&copy; <?= date('Y') ?> Ricardo Martinez</p>
            <p class="pull-right">Demo version</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
