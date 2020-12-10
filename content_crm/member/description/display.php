<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<section class="sTimeline">
	<?php if(!\dash\request::get('page') || \dash\request::get('page') == 1) {?>
	<div class="event">
		<div class="box">
			<form method="post" autocomplete="off" >
				<h2><?php echo T_("Add note"); ?></h2>
				<input type="hidden" name="redirecturl" value="<?php echo \dash\url::pwd(); ?>">
				<textarea class="txt " name="note" rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Write your note about user."); ?> <?php echo T_("Something like calls, favorites, hobbits, special approach or something else."); ?>'></textarea>
				<button class="btn secondary block mT5"><?php echo T_("Add new note"); ?></button>
			</form>
		</div>
	</div>
<?php } //endif ?>
	<?php foreach (\dash\data::dataTable() as $key => $value) {?>
		<div class="event" data-done>
			<div class="box">
				<div class="detail f">
					<div class="cauto"><i class="sf-certificate"></i><?php echo a($value, 'displayname'); ?></div>
					<div class="cauto os">
						<span data-confirm data-data='{"removenote": "removenote", "noteid" : "<?php echo a($value, 'id') ?>"}'><i class="sf-trash fc-red font-16"></i></span>
						<i class="sf-calendar-o pRa5"></i><?php echo \dash\fit::date_time($value['datecreated']); ?>
					</div>
				</div>
				<p><?php echo a($value, 'text'); ?></p>
			</div>
		</div>
	<?php } ?>
</section>
<?php \dash\utility\pagination::html(); ?>