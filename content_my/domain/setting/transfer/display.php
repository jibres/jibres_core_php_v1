<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">


			<div class="mB20" >

				<div class="f fs06">
					<div class="c6 s12">
						<div class="dcard x1 <?php if(\dash\data::domainDetail_lock()) { echo ' active';} ?>" data-confirm data-data='{"myaction" : "lock"}'>
						 <div class="statistic blue">
						  <div class="value"><i class="sf-lock"></i></div>
						  <div class="label"><?php echo T_("Lock domain"); ?></div>
						 </div>
						</div>
					</div>

					<div class="c6 s12">
						<div class="dcard x1 <?php if(!\dash\data::domainDetail_lock()) { echo ' active';} ?>" data-confirm data-data='{"myaction" : "unlock"}'>
						 <div class="statistic red">
						  <div class="value"><i class="sf-unlock"></i></div>
						  <div class="label"><?php echo T_("Unlock domain"); ?></div>
						 </div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>


