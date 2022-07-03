<div class="jibresBanner">
 <div class="avand impact">

<div class="f justify-center text-center mb-12">
	<div class="c6 s12 fs18">
		<div class="mb-2"><?php echo T_("Start lock"); ?></div>
		<br>
		<div class="mb-2"><?php echo \dash\fit::date(\dash\data::startLock()); ?></div>
		<br>
		<div class="mb-2"><?php echo \dash\fit::date(\dash\data::startLock()); ?></div>

	</div>
</div>

<div class="f justify-center text-center">

	<div class="c6 s12">
		<div data-confirm data-data='{"unlock" : "unlock"}' class="btn-success block xl">
			<?php echo T_("Force unlock"); ?>
		</div>
	</div>


</div>


 </div>
</div>