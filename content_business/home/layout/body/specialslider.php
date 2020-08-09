<?php

$specialslider = [];

if(isset($line_detail['value']['specialslider']) && is_array($line_detail['value']['specialslider']))
{
	$specialslider = $line_detail['value']['specialslider'];
}

$model = 'special';
if(isset($line_detail['value']['model']))
{
	$model = $line_detail['value']['model'];
}


?>



<?php if($model === 'simple') {?>
<?php if($specialslider) {?>
<div class="avand">
  <div class="jSlider1 mB10" data-slider>
	<?php foreach ($specialslider as $key => $value) {?>
		 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
    		<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
		</a>
    <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>
<?php } //endif ?>




<?php if($model === 'special') {?>
<?php if($specialslider && count($specialslider) >= 5) {?>
<div class="avand">

  <div class="row padLess">
    <div class="c-xs-12 c-sm-12 c-lg-6">
    	<?php if(count($specialslider) === 5) {?>
			<a class="roundedBox"<?php if(\dash\get::index($specialslider, 0, 'url')) { echo ' href="'.  \dash\get::index($specialslider, 0, 'url'). '"'; if(\dash\get::index($specialslider, 0, 'target')) { echo ' target="_blank"'; }} ?>>
            <figure class="overlay">
			  			<img src="<?php echo \lib\filepath::fix(\dash\get::index($specialslider, 0, 'image')); ?>" alt="<?php echo \dash\get::index($specialslider, 0, 'alt'); ?>">
	            <figcaption><h2><?php echo \dash\get::index($specialslider, 0, 'alt'); ?></h2></figcaption>
            </figure>
          </a>
    	<?php unset($specialslider[0]); }else{  // count > 5?>
	    	<div class="jSlider1" data-slider>
	    		<?php
	    		$count_foreach = count($specialslider) - 4;
	    		$count = 0;
	    		?>
				<?php foreach ($specialslider as $key => $value) { $count++;?>
					 <a class="roundedBox"<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
					 	<figure class="overlay">
			    		<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
	             <figcaption><h2><?php echo \dash\get::index($value, 'alt'); ?></h2></figcaption>
			    	</figure>
					</a>
			    <?php  unset($specialslider[$key]); if($count >= $count_foreach) { break;} } //endfor ?>
	  		</div>
    	<?php } //endif ?>

    </div>
    <div class="c-xs-12 c-sm-12 c-lg-6 ">
      <div class="row padLess">
        <?php foreach ($specialslider as $key => $value) {?>
	        <div class="c-6">
	          <a class="roundedBox"<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
	            <figure class="overlay">
	              <img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
	              <figcaption><h2><?php echo \dash\get::index($value, 'alt'); ?></h2></figcaption>
	            </figure>
	          </a>
	        </div>
        <?php } //endfor ?>
      </div>
    </div>
  </div>

</div>
<?php } //endif ?>
<?php } //endif ?>