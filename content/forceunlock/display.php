<div class="jibresBanner">
 <div class="avand">

<div class="f justify-center txtC mB50">
	<div class="c6 s12 fs18">
		<div class="mB10"><?php echo T_("Start lock"); ?></div>
		<br>
		<div class="mB10"><?php echo \dash\fit::date(\dash\data::startLock()); ?></div>
		<br>
		<div class="mB10"><?php echo \dash\fit::date(\dash\data::startLock()); ?></div>

	</div>
</div>

<div class="f justify-center txtC">

	<div class="c6 s12">
		<div data-confirm data-data='{"unlock" : "unlock"}' class="btn success block xl">
			<?php echo T_("Force unlock"); ?>
		</div>
	</div>


</div>


 </div>
</div>