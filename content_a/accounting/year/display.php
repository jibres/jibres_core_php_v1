	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v1 fs14">
			<thead>
				<tr>
					<th class="collapsing"><?php echo T_("Title") ?></th>
					<th class="collapsing"><?php echo T_("Start date") ?></th>
					<th class="collapsing"><?php echo T_("End date") ?></th>
					<th><?php echo T_("Status") ?></th>
					<th></th>
					<th class="collapsing"><?php echo T_("Edit") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr>
						<td class="collapsing"><?php echo \dash\get::index($value, 'title') ?></td>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'startdate')) ?></td>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'enddate')) ?></td>
						<td class="collapsing"><?php echo T_(\dash\get::index($value, 'status')) ?></td>
						<td>
							<?php if(\dash\get::index($value, 'isdefault')) {?>
								<div class="badge success"><?php echo T_("Current accounting year") ?></div>
							<?php }else{ ?>
								<div class="btn link" data-confirm data-data='{"setdefault": "setdefault", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Set as default year") ?></div>
							<?php } //endif ?>
						</td>
						<td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
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
		<?php if(\dash\face::help()) {?>
		<div class="txtRa font-16 fc-mute"><?php echo T_("Learn more about :val", ['val' => '<a class="link" href="'. \dash\face::help(). '">'. \dash\face::title(). '</a>'] ); ?><i class="compact sf-question-circle mLa5"></i></div>
		<?php }?>
	<?php } //endif ?>
