<?php

$specialslider = [];

if(isset($line_detail['value']['specialslider']) && is_array($line_detail['value']['specialslider']))
{
	$specialslider = $line_detail['value']['specialslider'];
}

?>

<?php if($specialslider && count($specialslider) >= 5) {?>
<div class="avand">

  <div class="f roundedBox mB5 topNews">
    <div class="c6 s12 pRa10 mB5">
    	<?php if(count($specialslider) === 5) {?>
			<a<?php if(\dash\get::index($specialslider, 0, 'url')) { echo ' href="'.  \dash\get::index($specialslider, 0, 'url'). '"'; if(\dash\get::index($specialslider, 0, 'target')) { echo ' target="_blank"'; }} ?>>
            <figure>
			  <img src="<?php echo \lib\filepath::fix(\dash\get::index($specialslider, 0, 'image')); ?>" alt="<?php echo \dash\get::index($specialslider, 0, 'alt'); ?>">
            </figure>
          </a>
    	<?php unset($specialslider[0]); }else{  // count > 5?>
	    	<div class="jSlider1 mB10" data-slider>
	    		<?php
	    		$count_foreach = count($specialslider) - 4;
	    		$count = 0;
	    		?>
				<?php foreach ($specialslider as $key => $value) { $count++;?>
					 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
			    		<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
					</a>
			    <?php  unset($specialslider[$key]); if($count >= $count_foreach) { break;} } //endfor ?>
	  		</div>
    	<?php } //endif ?>

    </div>
    <div class="c6 s12">
      <div class="f">
        <?php foreach ($specialslider as $key => $value) {?>
	        <div class="c6 s12 pRa10 mB5">
	          <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
	            <figure>
	              <img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
	            </figure>
	          </a>
	        </div>
        <?php } //endfor ?>
      </div>
    </div>
  </div>

</div>
<?php } //endif ?>