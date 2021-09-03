<?php

$slider = [];

if(isset($line_detail['value']['slider']) && is_array($line_detail['value']['slider']))
{
	$slider = $line_detail['value']['slider'];
}

?>

<?php if($slider) {?>
<div class="avand">
  <div class="jSlider1 mB10" data-slider>
	<?php foreach ($slider as $key => $value) {?>
		 <a<?php if(a($value, 'url')) { echo ' href="'.  a($value, 'url'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
    		<img src="<?php echo \lib\filepath::fix(a($value, 'image')); ?>" alt="<?php echo a($value, 'alt'); ?>">
		</a>
    <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>