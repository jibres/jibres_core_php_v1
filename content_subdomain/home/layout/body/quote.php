<?php

$quote = [];

if(isset($line_detail['value']['quote']) && is_array($line_detail['value']['quote']))
{
	$quote = $line_detail['value']['quote'];
}

?>

<?php if($quote) {?>
<div class="fit">
	<a href="<?php echo \dash\get::index($quote, 'url') ?>" <?php if(\dash\get::index($quote, 'target')) { echo 'target="_blank"'; } ?>>
		<p><?php echo \dash\get::index($quote, 'quote') ?></p>
	</a>
</div>
<?php } //endif ?>