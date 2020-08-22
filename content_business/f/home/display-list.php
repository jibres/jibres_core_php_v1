<div class="avand category">
<?php $dataTable = \dash\data::dataTable(); ?>
	<div class="row">
		<?php foreach ($dataTable as $key => $value) {?>
		<div class="c-xs-6 c-sm-6 c-md-4 c-lg-4 c-xl-3 c-xxl-2">
			<div class="roundedBox"<?php if(!\dash\get::index($value, 'file')) { echo ' data-gr="'.rand(1, 20).'"';} ?>>
				<a class="overlay"<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; } ?>>
        	<figure>
	  				<img src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
          	<figcaption><h2><?php echo \dash\get::index($value, 'title'); ?></h2></figcaption>
        	</figure>
      	</a>
			</div>
  	</div>
		<?php } //endif ?>
	</div>
<?php \dash\utility\pagination::html(); ?>
</div>