<div class="row">
	<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root. 'content_a/form/itemLink.php');?>
	</div>
	<div class="c-xs-12 c-sm-12 c-lg-8">
		<form method="post" autocomplete="off" id="form1">
			<div class="box">
				<div class="pad">


					<label for="redirect"><?php echo T_("Redirect after submit") ?></label>
					<div class="input">
						<input type="url" name="redirect" value="<?php echo \dash\data::dataRow_redirect(); ?>">
					</div>

					<div class="mB10">
						<label for="endmessage"><?php echo T_("End message") ?></label>
						<textarea name="endmessage" data-editor='simple' class="txt" rows="3" id="endmessage" placeholder="<?php echo T_("End message") ?>"><?php echo \dash\data::dataRow_endmessage(); ?></textarea>
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
