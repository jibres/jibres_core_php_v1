<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

				<form method="post" autocomplete="off" class="mB20" >
					<p><?php echo T_("You can edit your dns record") ?></p>
					<div class="c6 s12">
					    <label for="ns1"><?php echo T_("DNS #1"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
						</div>
						<label for="ns2"><?php echo T_("DNS #2"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
						</div>
			    	</div>

					<div class="txtRa">
						<button class="btn success"><?php echo T_("Update"); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


