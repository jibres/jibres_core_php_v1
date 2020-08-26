<?php

$imageblock = [];

if(isset($line_detail['value']['imageblock']) && is_array($line_detail['value']['imageblock']))
{
	$imageblock = $line_detail['value']['imageblock'];
}

?>

<?php if($imageblock) {?>


<div class="avand imgLine">
  <div class="row">
  	<?php $count = count($imageblock); ?>
	<?php foreach ($imageblock as $key => $value) {?>
    	<div class="c <?php if(count($imageblock) === 2){ echo 'c-xs-12'; } ?>">
			 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
				<img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'alt'); ?>">
			</a>
		</div>
	<?php } //endif ?>
  </div>
</div>
<?php } //endif ?>