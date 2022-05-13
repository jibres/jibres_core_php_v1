<?php
$html = '';



echo $html;
?>
<section class="row">
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/pages' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Pages") ?></div>
			</div>
		</a>
	</div>
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::kingdom(). '/a/setting/menu' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Menu") ?></div>
			</div>
		</a>
	</div>
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::kingdom(). '/a/setting/domain' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Domain") ?></div>
			</div>
		</a>
	</div>
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/sitemap' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Sitemap") ?></div>
			</div>
		</a>
	</div>
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/staticfile' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Static file") ?></div>
			</div>
		</a>
	</div>



</section>
