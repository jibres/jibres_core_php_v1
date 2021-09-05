<?php

$specialslider = [];
$specialsliderRatio = 16/9;

if(isset($line_detail['value']['specialslider']) && is_array($line_detail['value']['specialslider']))
{
	$specialslider = $line_detail['value']['specialslider'];
}
if(isset($line_detail['value']['ratio']) && is_array($line_detail['value']['ratio']))
{
	$specialsliderRatio = $line_detail['value']['ratio'];
}
if($specialsliderRatio)
{
	$specialsliderRatio = round($specialsliderRatio, 2);
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
  <div class="jSlider1 mB10" data-slider <?php echo 'data-slider-ratio="'.$specialsliderRatio. '"'; ?>>
	<?php foreach ($specialslider as $key => $value) {?>
		 <a<?php if(a($value, 'url')) { echo ' href="'.  a($value, 'url'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
    		<img src="<?php echo \lib\filepath::fix(a($value, 'image')); ?>" alt="<?php echo a($value, 'alt'); ?>">
		</a>
    <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>
<?php } //endif ?>




<?php if($model === 'special') {?>
<?php if($specialslider && count($specialslider) >= 5) {?>
<div class="avand">

  <div class="row">
    <div class="c-xs-12 c-sm-12 c-lg-6">
    	<?php if(count($specialslider) === 5) {?>
			<a class="roundedBox"<?php if(a($specialslider, 0, 'url')) { echo ' href="'.  a($specialslider, 0, 'url'). '"'; if(a($specialslider, 0, 'target')) { echo ' target="_blank"'; }} ?>>
            <figure class="overlay">
			  			<img src="<?php echo \lib\filepath::fix(a($specialslider, 0, 'image')); ?>" alt="<?php echo a($specialslider, 0, 'alt'); ?>">
	            <figcaption><h2><?php echo a($specialslider, 0, 'alt'); ?></h2></figcaption>
            </figure>
          </a>
    	<?php unset($specialslider[0]); }else{  // count > 5?>
	    	<div class="jSlider1" data-slider <?php echo 'data-slider-ratio="'.$specialsliderRatio. '"'; ?>>
	    		<?php
	    		$count_foreach = count($specialslider) - 4;
	    		$count = 0;
	    		?>
				<?php foreach ($specialslider as $key => $value) { $count++;?>
					 <a class="roundedBox"<?php if(a($value, 'url')) { echo ' href="'.  a($value, 'url'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
					 	<figure class="overlay">
			    		<img src="<?php echo \lib\filepath::fix(a($value, 'image')); ?>" alt="<?php echo a($value, 'alt'); ?>">
	             <figcaption><h2><?php echo a($value, 'alt'); ?></h2></figcaption>
			    	</figure>
					</a>
			    <?php  unset($specialslider[$key]); if($count >= $count_foreach) { break;} } //endfor ?>
	  		</div>
    	<?php } //endif ?>

    </div>
    <div class="c-xs-12 c-sm-12 c-lg-6 ">
      <div class="row">
        <?php foreach ($specialslider as $key => $value) {?>
	        <div class="c-6">
	          <a class="roundedBox"<?php if(a($value, 'url')) { echo ' href="'.  a($value, 'url'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
	            <figure class="overlay">
	              <img src="<?php echo \lib\filepath::fix(a($value, 'image')); ?>" alt="<?php echo a($value, 'alt'); ?>">
	              <figcaption><h2><?php echo a($value, 'alt'); ?></h2></figcaption>
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