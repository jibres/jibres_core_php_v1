<div class="jFooter201" data-footer=201>
	<div class="avand-xl">

		<div class="top">
			<div class="row align-end">
				<div class="c-xs-12 c-sm-12 c-md">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h3>
					<p><?php echo \lib\store::desc(); ?></p>
				</div>
				<div class="c-xs-12 c-sm-12 c-md-auto">
					<div class="certifications txtRa">
						<?php \lib\website::load_enamd(); ?>
						<?php \lib\website::load_samandehi(); ?>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<?php if(\lib\website::have_footer_menu()) {?>
		<nav class="mid">
			<div class="f">
				<div class="c3">
					<?php \lib\website::menu_with_title('footer_menu_1'); ?>
				</div>

				<div class="c3">
					<?php \lib\website::menu_with_title('footer_menu_2'); ?>
				</div>

				<div class="c3">
					<?php \lib\website::menu_with_title('footer_menu_3'); ?>
				</div>

				<div class="c3">
					<?php \lib\website::menu_with_title('footer_menu_4'); ?>
				</div>

			</div>
		</nav>
		<hr>
	<?php } //endif ?>
		<div class="bottom ltr">
			<p><?php echo \dash\get::index($website, 'footer', 'maintext', 'text') ?></p>
		</div>
	</div>
</div>