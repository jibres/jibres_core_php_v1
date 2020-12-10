<?php
$imageblock = [];

if(isset($line_detail['value']['imageblock']) && is_array($line_detail['value']['imageblock']))
{
	$imageblock = $line_detail['value']['imageblock'];
}
if($imageblock)
{
	$myItemClass = 'c';
	switch (count($imageblock))
	{
		case 1:
		case 3:
		case 4:
		case 5:
			$myItemClass = 'c';
			break;

		case 2:
			$myItemClass = 'c-xs-12 c-sm-6';
			break;

		case 6:
			$myItemClass = 'c-xs-12 c-sm-4';
			break;

		default:
			break;
	}
?>


<div class="avand imgLine">
  <div class="row">
  	<?php $count = count($imageblock); ?>
	<?php foreach ($imageblock as $key => $value) {?>
    	<div class="<?php echo $myItemClass; ?>">
			 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
				<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
			</a>
		</div>
	<?php } //endif ?>
  </div>
</div>
<?php } //endif ?>