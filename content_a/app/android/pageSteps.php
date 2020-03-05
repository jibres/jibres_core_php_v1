<div class="f">

	<div class="c s12">
		<a href="<?php echo \dash\url::that(); ?>/splash" class="dcard x1 <?php if(\dash\url::subchild() === 'splash') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-googleplus"></i></div>
		  <div class="label"><?php echo T_("Splash"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s12">
		<a href="<?php echo \dash\url::that(); ?>/intro" class="dcard x1 <?php if(\dash\url::subchild() === 'intro') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-in-alt"></i></div>
		  <div class="label"><?php echo T_("Intro"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s12">
		<a href="<?php echo \dash\url::that(); ?>/setting" class="dcard x1 <?php if(\dash\url::subchild() === 'setting') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-windows-2"></i></div>
		  <div class="label"><?php echo T_("Title & logo"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s12">
		<a href="<?php echo \dash\url::that(); ?>/apk" class="dcard x1 <?php if(\dash\url::subchild() === 'apk') { echo ' active';} ?>" >
		 <div class="statistic green">
		  <div class="value"><i class="sf-android-1"></i></div>
		  <div class="label"><?php echo T_("Download APK"); ?></div>
		 </div>
		</a>
	</div>



</div>