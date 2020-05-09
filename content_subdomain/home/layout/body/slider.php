<?php

$slider = [];

if(isset($line_detail['line_key']))
{
	$slider = \lib\app\website\body\slider::get($line_detail['line_key']);
}

?>

<?php if($slider) {?>
<div class="fit">
  <div class="jSlider1 mB10" data-slick>
	<?php foreach ($slider as $key => $value) {?>
		<a href="<?php echo \dash\get::index($value, 'url') ?>" <?php if(\dash\get::index($value, 'target')) { echo 'target="_blank"'; } ?>>
    		<img src="<?php echo \dash\get::index($value, 'image'); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
		</a>
    <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>