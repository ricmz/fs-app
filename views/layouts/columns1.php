<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container-fluid">
    <?= app\models\General::mensajeGlobal(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>