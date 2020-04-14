
<div class="f justify-center">
	<div class="c6 m8 s12">
		<?php require_once (__DIR__. '/../dnsForm.php'); ?>

		<?php if(!\dash\data::dataRow_count_useage()) {?>

			<div class="cbox">
				<p>
					<?php echo T_("Remove DNS"); ?>
				</p>

				<div class="txtRa">
					<button data-confirm data-data='{"myaction": "remove"}' class="btn danger"><?php echo T_("Remove"); ?></button>
				</div>
			</div>
		<?php } // endif ?>

	</div>
</div>


