<?php
$html = '';



echo $html;
?>
<section class="row">
	<?php if(\content_site\homepage::id()) {?>
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/page?id='. \content_site\homepage::code() ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Edit homepage") ?></div>
			</div>
		</a>
	</div>
	<?php } //endif ?>

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
	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/autosave' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Setting auto-save and publish") ?></div>
			</div>
		</a>
	</div>

	<div class="c-xs-12 c-4 mb-1">
		<a href="<?php echo \dash\url::this(). '/portfolio' ?>">
			<div class="bg-white rounded-lg flex justify-center items-center align-middle h-16 w-full block">
				<div class="text-center "><?php echo T_("Jibres portfolio") ?></div>
			</div>
		</a>
	</div>






</section>
