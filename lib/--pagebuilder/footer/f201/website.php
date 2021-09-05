<?php $footer = \dash\data::currentFooter(); ?>
<div class="jFooter201" data-footer=201>
	<div class="avand-xl">

		<div class="top">
			<div class="row align-end">
				<div class="c-xs-12 c-sm-12 c-md">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo \lib\store::title(); ?></a></h3>
					<p><?php echo \lib\store::desc(); ?></p>
				</div>
				<div class="c-xs-12 c-sm-12 c-md-auto">
					<div class="certifications txtRa">
						<?php \lib\pagebuilder::load_enamd(); ?>
						<?php \lib\pagebuilder::load_samandehi(); ?>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<?php if(\lib\pagebuilder::have_footer_menu()) { ?>
		<nav class="mid">
			<div class="f">
				<div class="c3">
					<?php echo \lib\pagebuilder::menu('footer_menu_1'); ?>
				</div>

				<div class="c3">
					<?php echo \lib\pagebuilder::menu('footer_menu_2'); ?>
				</div>

				<div class="c3">
					<?php echo \lib\pagebuilder::menu('footer_menu_3'); ?>
				</div>

				<div class="c3">
					<?php echo \lib\pagebuilder::menu('footer_menu_4'); ?>
				</div>

			</div>
		</nav>
		<hr>
	<?php } //endif ?>
		<div class="bottom ltr">
			<p><?php echo a($footer, 'text') ?></p>
		</div>
	</div>
</div>