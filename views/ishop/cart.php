<?php defined('ISHOP') or die('Access denied'); ?>
<div id="content-zakaz">
	<h2>Оформление заказа</h2>
 <?php if($_SESSION['cart']): // проверка корзины, если в корзине есть товары ?>
	<table class="zakaz-maiin-table" border="0" cellspacing="0" cellpadding="0">
	<form method="post" action="">
	  <tr>
		<td class="z_top">&nbsp;&nbsp;&nbsp;&nbsp;наименование</td>
		<td class="z_top" align="center">количество</td>
		<td class="z_top" align="center">стоимость</td>
		<td class="z_top" align="center">&nbsp;</td>
	  </tr>
<?php foreach($_SESSION['cart'] as $key => $item): ?>
	  <tr>
		<td class="z_name">
			<a href="#"><img src="<?=PRODUCTIMG?><?=$item['img']?>" width="32" title="" /></a> 
			<a href="#"><?=$item['name']?></a>
		</td>
		<td class="z_kol"><input id="<?= $key ?>" class="kolvo" type="text" value="<?=$item['qty']?>" name="" /></td>
		<td class="z_price"><?=$item['price']?></td>
		<td class="z_del"><a class="confirm" href="?view=cart&delete=<?=$key?>"><img src="<?=TEMPLATE?>images/delete.jpg" title="удалить товар из заказа" /></a></td>
	  </tr>
<?php endforeach; ?>
	  <tr>
		<td class="z_bot">&nbsp;&nbsp;&nbsp;&nbsp;Итого:</td>
		<td class="z_bot" colspan="3" align="right"><?=$_SESSION['total_qty']?> шт &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$_SESSION['total_sum']?> руб.</td>
	  </tr>
	  <tr>
          <td class="z_bot">&nbsp;&nbsp;&nbsp;&nbsp;Очистить корзину:</td>
          <td class="z_bot" colspan="3" align="right"><a class="confirm" href="?view=cart&delete_all=1"><img src="<?=TEMPLATE?>images/delete.jpg" title="удалить товар из заказа" /></a></td>
      </tr>
	</table>
	


	</table>
        <p class="result-msg"></p>
		<input class="zakazat-success" type="image" src="<?=TEMPLATE?>images/zakazat.jpg" />

		<br /><br /><br /><br />
	
	
	</form>
    <?php else: // если товаров нет ?>
        Корзина пуста
    <?php endif; // конец условия проверки корзины ?>
</div> <!-- .content-zakaz -->