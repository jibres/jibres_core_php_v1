<div class="jFooterRafiei">
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve">
		<style type="text/css">
			.st0{opacity:0.7;fill:#053657;enable-background:new;}
			.st1{fill:#053657;}
		</style>
		<path class="st0" d="M2000,100V0c-312.4,67.2-649.1,98.6-1000,98.6S312.4,67.1,0,0v100H2000z"/>
		<path class="st0" d="M2000,100V26.6c-312.4,46.6-649.1,72-1000,72S312.4,73.1,0,26.5V100H2000z"/>
		<path class="st1" d="M2000,100V53.1c-312.4,29.4-649.1,45.5-1000,45.5S312.4,82.5,0,53v47H2000z"/>
	</svg>


	<div class="avand-xl">

		<div class="top">
			<div class="row align-end">
				<div class="c-xs-12 c-sm-12 c-md">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo a(\lib\store::detail(), 'store_data', 'title'); ?></a></h3>
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
		<?php if(\lib\pagebuilder::have_footer_menu()) {?>
		<nav class="mid">
			<div class="f">
				<div class="c3">
					<?php \lib\pagebuilder::menu('footer_menu_1'); ?>
				</div>

				<div class="c3">
					<?php \lib\pagebuilder::menu('footer_menu_2'); ?>
				</div>

				<div class="c3">
					<?php \lib\pagebuilder::menu('footer_menu_3'); ?>
				</div>

				<div class="c3">
					<?php \lib\pagebuilder::menu('footer_menu_4'); ?>
				</div>

			</div>
		</nav>
		<hr>
	<?php } //endif ?>
		<div class="bottom ltr">
			<p><?php echo a(\dash\data::website(), 'footer', 'maintext', 'text') ?></p>
		</div>
	</div>
</div>