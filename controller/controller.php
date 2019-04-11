<?php

defined('ISHOP') or die('Access denied');

// подключение модели
require_once MODEL;

// подключение библиотеки функций
require_once 'functions/functions.php';

// получение массива каталога
$cat = catalog($connect);

// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'hits' : $_GET['view'];

// подключени вида
require_once TEMPLATE.'index.php';