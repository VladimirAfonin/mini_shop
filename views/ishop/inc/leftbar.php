<?php defined('ISHOP') or die('Access denied'); ?>
<div id="left-bar">
			<div class="left-bar-cont">
				<h2>Каталог</h2>
                <br>
                <!-- Меню категорий -->
				<h4>- Мобильные телефоны</h4>
				<ul class="nav-catalog" id="accordion">
                    <?php foreach($cat as $key => $item): ?>
                        <?php if(count($item) > 1): // если это родительская категория ?>
                        <h3><li><a href="#"><?=$item[0]?></a></li></h3>
                            <ul>
                                <li>- <a href="?view=cat&category=<?=$key?>">Все модели</a></li>
                                <?php foreach($item['sub'] as $key => $sub): ?>
                                <li>- <a href="?view=cat&category=<?=$key?>"><?=$sub?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php elseif($item[0]): // если самостоятельная категория ?>
                            <li><a href="?view=cat&category=<?=$key?>"><?=$item[0]?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
				</ul>
                <!-- Меню категорий -->

                <!-- Информеры -->
                <?php foreach($informers as $informer): ?>
                <div class="info">
                    <h3><?=$informer[0]?></h3>
                    <?php foreach($informer['sub'] as $key => $sub): ?>
                    <p>- <a href="?view=informer&id=<?=$key?>"><?=$sub?></a></p>
                    <?php endforeach; ?>
                </div> <!-- .info -->
                <?php endforeach; ?>
                <!-- Информеры -->
			</div>		
		</div>