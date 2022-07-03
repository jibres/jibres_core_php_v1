<?php if(\dash\data::dataTable()) {?>
	<div class="row">
		<?php foreach (\dash\data::dataTable() as $key => $value) {?>
			<div class="c-xs-12 c-sm-6 c-md-3">

				<div class="box">
					<div class="body">
						<h4><?php echo a($value, 'title') ?></h4>
						<div class=""><?php echo T_("Start date") ?> <b class="inline-block ltr text-left"><?php echo \dash\fit::date(a($value, 'startdate')) ?></b></div>
						<div class=""><?php echo T_("End date") ?> <b class="inline-block ltr text-left"><?php echo \dash\fit::date(a($value, 'enddate')) ?></b></div>
						<?php if(a($value, 'isdefault')) {?>
							<div class="link-success font-bold"><?php echo T_("Current accounting year") ?></div>
						<?php }else{ ?>
							<div class="link-primary" data-confirm data-data='{"setdefault": "setdefault", "id" : "<?php echo a($value, 'id') ?>"}'><?php echo T_("Set as default year") ?></div>
						<?php } //endif ?>
						<a target="_blank" class="link-primary" href="<?php echo \dash\url::this(). '/doc/printall'; ?>"><?php echo T_("Print all accounting document") ?></a>
					</div>
					<footer class="txtRa">
						<a class="btn master" href="<?php echo \dash\url::that(). '/manage?id='. a($value, 'id'); ?>"><?php echo T_("Manage") ?></a>
					</footer>
				</div>
			</div>
		<?php } //endif ?>
	</div>

	<?php }else{ ?>

		<section class="box">
			<div class="row">
				<div class="c-8">
					<video class="infoVideo" controls autoplay preload="auto">
						<source src="<?php echo \dash\url::cdn(); ?>/video/domino.mp4" type="video/mp4">
					</video>
				</div>
				<aside class="c-4 body">
					<div class="f align-center justify-center">
						<h2><?php echo \dash\face::title(); ?></h2>
						<p><?php echo T_("There is nothing here."); ?></p>
						<?php if(\dash\data::action_text() && \dash\data::action_link() && false) { ?>
							<a class="btn master" href="<?php echo \dash\data::action_link(); ?>"><?php echo \dash\data::action_text(); ?></a>
						<?php } ?>
					</div>
				</aside>
			</div>
		</section>
		<?php if(false) {?>
		<div class="txtRa font-16 text-gray-400"><?php echo T_("Learn more about :val", ['val' => '<a class="link-primary" href="'. \dash\face::help(). '">'. \dash\face::title(). '</a>'] ); ?><i class="inline-block sf-question-circle mLa5"></i></div>
		<?php }?>
	<?php } //endif ?>
