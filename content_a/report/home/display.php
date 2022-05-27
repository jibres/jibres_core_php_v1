
<div class="f">
	<div class="c6 s12">
		<nav class="items long">
			<ul>
				<li>
					<a class="item f" href="<?php echo \dash\url::this(); ?>/sale">
						<i class="sf-shopping-cart"></i>
						<div class="key"><?php echo T_("Sale report"); ?></div>
						<div class="go"></div>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<div class="c6 s12">
		<div class="mLa5">
			<nav class="items long">
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/products">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Products report"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="c6 s12">
		<div class="mLa5">
			<h4 class="mb-2"><?php echo T_("Sales report by product over time") ?></h4>
			<nav class="items long">
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/productsalesovertime">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Sales report by product by date"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/productsalesovertime?type=period">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Sales report by product over time"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/productsalesovertime?type=month">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Sales report by product over month"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/productsalesovertime?type=year">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Sales report by product over year"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<?php if(false) {?>
	<div class="c6 s12">
		<div class="mLa5">
			<h4><?php echo T_("Sales over time") ?></h4>
			<nav class="items long">
				<ul>
					<li>
						<a class="item f" href="<?php echo \dash\url::this(); ?>/salesovertime">
							<i class="sf-tags"></i>
							<div class="key"><?php echo T_("Sales report over date"); ?></div>
							<div class="go"></div>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
<?php } //endif ?>
</div>
