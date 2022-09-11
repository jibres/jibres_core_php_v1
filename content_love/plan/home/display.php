<section class="f">
	<div class="c pRa10">
		<a href="<?php echo \dash\url::current(). '/datalist' ?>" class="stat">
			<h3><?php echo T_("Plan history list");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
	</div>

	<div class="c pRa10">
		<a href="<?php echo \dash\url::current(). '/datalist?plan=free'; ?>" class="stat">
			<h3><?php echo T_("Free plan");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
	</div>

	<div class="c pRa10">
		<a href="<?php echo \dash\url::current(). '/datalist?plan=gold'; ?>" class="stat">
			<h3><?php echo T_("Gold plan");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
	</div>

	<div class="c pRa10">
		<a href="<?php echo \dash\url::current(). '/datalist?status=failed'; ?>" class="stat">
			<h3><?php echo T_("Test");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
	</div>
	<div class="c3 s12">
		<a href="<?php echo \dash\url::current(). '/add'; ?>" class="stat">

			<div class="val"><?php echo T_("Add plan to business") ?></div>
		</a>
	</div>
</section>

<section class="f">
	<div class="c9 s12 pRa10">
		<div id="chartdivactionday" class="box chart x210" data-hint1='Action lasy 30 days per date' data-abc='management/domainhomepage'></div>
	</div>
	<div class="c3 s12">
		<a href="<?php echo \dash\url::current(). '/datalist?addcdnpanel=yes'; ?>" class="stat">
			<h3><?php echo T_("Added to CDN panel");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
		<a href="<?php echo \dash\url::current(). '/datalist?addcdnpanel=no'; ?>" class="stat">
			<h3><?php echo T_("Not added to CDN panel");?></h3>
			<div class="val"><?php echo \dash\fit::stats(rand());?></div>
		</a>
	</div>
</section>


