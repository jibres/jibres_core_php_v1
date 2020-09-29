<div class="jFooter201" data-footer=201>
	<div class="avand-xl">

		<div class="top">
			<div class="row align-end">
				<div class="c-xs-12 c-sm-12 c-md">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h3>
					<p><?php echo \dash\get::index($website, 'footer', 'maintext', 'text') ?></p>
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
		<div class="bottom ltr">
			<p>&copy; <?php echo \dash\datetime::fit(null, 'Y'). '. '. T_('All rights reserved.'); ?> <a href="/privacy"><?php echo T_("Privacy") ?></a> <?php echo T_("And"); ?> <a href="/terms"><?php echo T_("Terms") ?></a>.</p>
		</div>
	</div>
</div>