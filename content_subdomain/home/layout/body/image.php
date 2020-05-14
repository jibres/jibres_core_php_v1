<?php

$image = [];

if(isset($line_detail['value']['image']) && is_array($line_detail['value']['image']))
{
	$image = $line_detail['value']['image'];
}

// image, url, alt, target
?>

<?php if($image) {?>
<div class="fit">
	<p><?php echo \dash\get::index($image, 'image') ?></p>
</div>
<?php } //endif ?>