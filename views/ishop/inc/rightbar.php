<?php defined('ISHOP') or die('Access denied'); ?>
<div id="right-bar">
			<div class="right-bar-cont">
				<div class="enter">
					<h2>Авторизация</h2>
					<div>
						<a href="#"><img src="<?=TEMPLATE?>images/enter.jpg" alt="" /></a>
					</div>	
				</div>	
				<div class="basket">
					<h2>Корзина</h2>
					<div>
                        <p>
                            <?php if($_SESSION['total_qty']): ?>
                                Товаров в корзине: <br>
                            <span><?= $_SESSION['total_qty']?></span> на сумму <span><?= $_SESSION['total_sum'] ?></span>rur
                                <a href="#"><img src="<?=TEMPLATE?>images/oformit.jpg" alt="" /></a>
                            <?php else: ?>
                            <p>Корзина пуста</p>
                            <?php endif; ?>
                        </p>
						
					</div>
				</div>
			</div>
		</div>