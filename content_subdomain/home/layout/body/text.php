<?php

$text = [];

if(isset($line_detail['value']['text']) && is_array($line_detail['value']['text']))
{
	$text = $line_detail['value']['text'];
}

?>

<?php if($text) {?>
<div class="fit">
	<p><?php echo \dash\get::index($text, 'text') ?></p>
</div>
<?php } //endif ?>