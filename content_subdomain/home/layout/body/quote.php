<?php

$quote = [];

if(isset($line_detail['value']['quote']) && is_array($line_detail['value']['quote']))
{
	$quote = $line_detail['value']['quote'];
}
// @TODO @Reza . if count of quote > 3 get random
?>

<?php if($quote) {?>
<div class="fit">

	<?php foreach ($quote as $key => $value) {?>
    		<img class="avatar" src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'displayname'); ?>">
		 	<b><?php echo \dash\get::index($value, 'displayname') ?> <small><?php echo \dash\get::index($value, 'job') ?></small></b>
		 	<div class="ltr"><?php if(\dash\get::index($value, 'star')) { echo str_repeat('⭐️', \dash\get::index($value, 'star')); } ?></div>
    		<p><?php echo \dash\get::index($value, 'text') ?></p>

    <?php } //endif ?>

</div>
<?php } //endif ?>