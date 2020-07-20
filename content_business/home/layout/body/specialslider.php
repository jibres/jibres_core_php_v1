<?php

$specialslider = [];

if(isset($line_detail['value']['specialslider']) && is_array($line_detail['value']['specialslider']))
{
	$specialslider = $line_detail['value']['specialslider'];
}

?>

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