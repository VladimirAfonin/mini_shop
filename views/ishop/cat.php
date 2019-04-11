<?php defined('ISHOP') or die('Access denied'); ?>
<div class="catalog-index"><br><br><br>

    <!--<div class="vid-sort">
		Вид: 
			<a href="#"><img src="<?/*=TEMPLATE*/?>images/vid-tabl.gif" alt="табличный вид" /></a>
			<a href="#"><img src="<?/*=TEMPLATE*/?>images/vid-line.gif" alt="табличный вид" /></a>
			&nbsp;&nbsp;           
		Сортировать по:&nbsp;    
			<a href="#" class="sort-top-act">цене</a>  &nbsp;|&nbsp;     
			<a href="#" class="sort-top">названию</a>  &nbsp;|&nbsp;     
			<a href="#" class="sort-bot">дате добавлеия</a>
	</div> -->
    <!-- .vid-sort -->

<?php if($products): // если получены товары категории ?>
<?php foreach($products as $product): ?>					
<div class="product-table">
	<h2><a href="?view=product&goods_id=<?=$product['goods_id']?>"><?=$product['name']?></a></h2>
	<div class="product-table-img">
		<a href="?view=product&goods_id=<?=$product['goods_id']?>"><img src="<?=TEMPLATE?>images/<?=$product['img']?>" alt="" width="64" /></a>
		<div>
			<img src="<?=TEMPLATE?>images/ico-cat-new.png" alt="новинка" />
			<img src="<?=TEMPLATE?>images/ico-cat-lider.png" alt="новинка" />							
		</div>
	</div>
	<p class="cat-table-more"><a href="?view=product&goods_id=<?=$product['goods_id']?>">подробнее...</a></p>
	<p>Цена :  <span><?=$product['price']?></span></p>
	<a href="?view=addtocart&goods_id=<?=$product['goods_id']?>"><img class="addtocard-index" src="<?=TEMPLATE?>images/addcard-table.jpg" alt="Добавить в корзину" /></a>
</div> <!-- .product-table -->
<?php endforeach; ?>
<?php else: ?>
    <p>Здесь товаров пока нет!</p>
<?php endif; ?>				
</div> <!-- .catalog-index -->