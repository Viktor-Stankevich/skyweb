<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="wrapper">
  <div class="container">
  <div class="row mb-5">
      <div class="col-md">
        <h1 class="text-center">Система бронирования</h1>
      </div>
    </div>
    <div class="row mb-5 info">
      <div class="col justify-content-center red"> 
        <div></div>
        <p> - забронирован</p>
      </div>
      <div class="col justify-content-center green">
        <div></div>
        <p> - выбран</p>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col d-flex justify-content-center">
        <h2>Сентябрь 2021</h2>
      </div>
    </div>
    <?= $content ?>
  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
