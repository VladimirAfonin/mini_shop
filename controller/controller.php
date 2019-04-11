<?php

defined('ISHOP') or die('Access denied');

// подключение модели
require_once MODEL;

// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'hits' : $_GET['view'];

// подключени вида
require_once TEMPLATE . 'index.php';