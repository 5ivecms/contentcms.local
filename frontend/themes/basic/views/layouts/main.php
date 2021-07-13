<?php

/* @var $this yii\web\View */
/* @var $content string */

use frontend\themes\basic\ThemeAsset;

use frontend\widgets\LastArticles\LastArticles;
use frontend\widgets\PopularArticles\PopularArticles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

ThemeAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/themes/<?= \common\models\Themes::current() ?>/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/themes/<?= \common\models\Themes::current() ?>/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/themes/<?= \common\models\Themes::current() ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/themes/<?= \common\models\Themes::current() ?>/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/themes/<?= \common\models\Themes::current() ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="/themes/<?= \common\models\Themes::current() ?>/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/themes/<?= \common\models\Themes::current() ?>/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php $this->head() ?>
    <script src="https://kit.fontawesome.com/05cb2122c0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>
<?php $branding = \common\models\Setting::getBrandingSettings(); ?>

<header id="masthead" class="site-header container" itemscope="" itemtype="http://schema.org/WPHeader">
    <div class="site-header-inner ">
        <div class="site-branding">
            <?php if ($branding['logo'] && !empty($branding['logo'])): ?>
                <div class="site-logotype">
                    <a href="<?= Url::to(['site/index']) ?>">
                        <img src="<?= $branding['logo'] ?>" alt="<?= $branding['title'] ? $branding['title'] : '' ?>"/>
                    </a>
                </div>
            <?php endif; ?>
            <div class="site-branding-container">
                <?php if (!empty($branding['title'])): ?>
                    <div class="site-title">
                        <a href="<?= Url::to(['site/index']) ?>"><?= $branding['title'] ?></a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($branding['description'])): ?>
                    <p class="site-description"><?= $branding['description'] ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div id="mobileBtn" class="mob-hamburger"><span></span></div>
    </div>
</header>
<nav id="mobile-menu" class="main-navigation container">
    <div class="main-navigation-inner ">
        <ul id="header_menu" class="menu">
            <li class="menu-item">
                <a href="<?= Url::to(['site/index']) ?>">Главная</a>
            </li>
            <li class="menu-item">
                <a href="<?= Url::to(['article/index']) ?>">Все статьи</a>
            </li>
        </ul>
    </div>
</nav>

<div id="content" class="site-content container">
    <div id="primary" class="content-area">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
    <div id="secondary" class="widget-area" itemscope itemtype="http://schema.org/WPSideBar">
        <?= $this->render('../_parts/search') ?>
        <?= PopularArticles::widget() ?>
        <?= LastArticles::widget() ?>
    </div>
</div>

<div class="footer-navigation container">
    <div class="main-navigation-inner ">
        <div class="menu-top-menu-container">
            <ul id="footer_menu" class="menu">
                <li class="menu-item">
                    <a href="<?= Url::to(['site/privacy']) ?>">Политика конфиденциальности</a>
                </li>
                <li class="menu-item">
                    <a href="<?= Url::to(['site/dmca']) ?>">Правообладателям</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<footer class="site-footer container" itemscope="" itemtype="http://schema.org/WPFooter">
    <div class="site-footer-inner ">
        <div class="footer-info">
            © <?= date('Y') ?> <?= Yii::$app->request->hostName ?>
        </div>
        <div class="footer-counters">
        </div>
    </div>
</footer>

<button type="button" class="scrolltop js-scrolltop"></button>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
