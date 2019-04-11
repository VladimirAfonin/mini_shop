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
	
	<div class="sposob-dostavki">
		<h4>Способы доставки:</h4>
			<p><input type="radio" name="1" value="1" /> Курьером, 200 руб</p> 
			<p><input type="radio" name="1" value="2" /> Самовывоз, бесплатно</p> 
			<p><input type="radio" name="1" value="3" /> В магазин, бесплатно</p> 
	</div>		
	
	
	<h3>Информация для доставки:</h3>
	
	<table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="zakaz-txt">ФИО</td>
		<td class="zakaz-inpt"><input type="text" name="address" /></td>
		<td class="zakaz-prim">Пример: Иванов Сергей Александрович</td>
	  </tr>
	  <tr>
		<td class="zakaz-txt">Е-маил</td>
		<td class="zakaz-inpt"><input type="text" name="address" /></td>
		<td class="zakaz-prim">Пример: test@mail.ru</td>
	  </tr>
	  <tr>
		<td class="zakaz-txt">Телефон</td>
		<td class="zakaz-inpt"><input type="text" name="address" /></td>
		<td class="zakaz-prim">Пример: 8 937 999 99 99</td>
	  </tr>
	  <tr>
		<td class="zakaz-txt">Адрес доставки</td>
		<td class="zakaz-inpt"><input type="text" name="address" /></td>
		<td class="zakaz-prim">Пример: г. Москва, пр. Мира, ул. Петра Великого д.19, кв 51.</td>
	  </tr>
	  <tr>
		<td class="zakaz-txt" style="vertical-align:top;">Примечание </td>
		<td class="zakaz-txtarea"><textarea></textarea></td>
		<td class="zakaz-prim" style="vertical-align:top;">Пример: Позвоните пожалуйста после 10 вечера, 
до этого времени я на работе </td>
	  </tr>
	</table>
		
		<input type="image" src="<?=TEMPLATE?>images/zakazat.jpg" /> 
		
		<br /><br /><br /><br />
	
	
	</form>
    <?php else: // если товаров нет ?>
        Корзина пуста
    <?php endif; // конец условия проверки корзины ?>
</div> <!-- .content-zakaz -->