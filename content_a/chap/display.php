<?php
if(\dash\data::printFileUrl())
{
	require_once (\dash\data::printFileUrl());
}
else
{
?>

<div class="msg warn2 txtC fs20"><?php echo T_("Please choose one format to print factor"); ?></div>

<?php } //endif ?>

