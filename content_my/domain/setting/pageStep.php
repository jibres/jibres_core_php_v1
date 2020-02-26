<div class="f">
	<div class="c s6">
		<a href="<?php echo \dash\url::that(). '?domain='. \dash\request::get('domain'); ?>" class="dcard x1 <?php if(!\dash\url::subchild()) { echo ' active';} ?>" >
		 <div class="statistic blue">
		  <div class="value"><i class="sf-info-circle"></i></div>
		  <div class="label"><?php echo T_("Domain Info"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s6">
		<a href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain'); ?>" class="dcard x1 <?php if(\dash\url::subchild() == 'holder') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-user-md"></i></div>
		  <div class="label"><?php echo T_("IRNIC Holder setting"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s6">
		<a href="<?php echo \dash\url::that(). '/dns?domain='. \dash\request::get('domain'); ?>" class="dcard x1 <?php if(\dash\url::subchild() == 'dns') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-internet"></i></div>
		  <div class="label"><?php echo T_("DNS setting"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s6">
		<a href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain'); ?>" class="dcard x1 <?php if(\dash\url::subchild() == 'transfer') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-exchange"></i></div>
		  <div class="label"><?php echo T_("Transfer"); ?></div>
		 </div>
		</a>
	</div>

	<div class="c s6">
		<a href="<?php echo \dash\url::that(). '/action?domain='. \dash\request::get('domain'); ?>" class="dcard x1 <?php if(\dash\url::subchild() == 'action') { echo ' active';} ?>" >
		 <div class="statistic">
		  <div class="value"><i class="sf-history"></i></div>
		  <div class="label"><?php echo T_("Action history"); ?></div>
		 </div>
		</a>
	</div>



</div>