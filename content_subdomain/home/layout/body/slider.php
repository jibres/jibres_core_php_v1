<?php

$slider = [];

if(isset($line_detail['value']['slider']) && is_array($line_detail['value']['slider']))
{
	$slider = $line_detail['value']['slider'];
}

?>

<?php if($slider) {?>
<div class="fit">
  <div class="jSlider1 mB10" data-slick>
	<?php foreach ($slider as $key => $value) {?>
		 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
    		<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
		</a>
    <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>