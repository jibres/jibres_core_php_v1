<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-md-4">
			  <?php require_once(root. 'content_subdomain/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-md-8">
			<div class="msg info2"><?php echo \dash\data::dataRow_id_code(); ?></div>
			<div class="msg info2"><?php echo \dash\fit::price(\dash\data::dataRow_total()); ?></div>
			<div class="msg info2"><?php echo \dash\fit::date_time(\dash\data::dataRow_date()); ?></div>
			<div class="msg info2"><?php echo \dash\data::dataRow_status(); ?></div>

		</div>
	</div>
</div>