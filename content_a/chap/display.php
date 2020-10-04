<div class="row p0">
	<div class="c-xs-12 c-sm-3">
		<nav class="items">
		 <ul>
		      <li><a class="f item" href="<?php echo \dash\url::this(). '/a4?id='. \dash\request::get('id'); ?>"><i class="sf-print"></i><div class="key"><?php echo T_("Print"). ' '. T_('A4');?></div><div class="go"></div></a></li>
		      <li><a class="f item" href="<?php echo \dash\url::this(). '/receipt?id='. \dash\request::get('id'); ?>"><i class="sf-print"></i><div class="key"><?php echo T_("Print"). ' '. T_('Receipt');?></div><div class="go"></div></a></li>
		 </ul>
		</nav>
	</div>
	<div class="c">

	</div>
</div>

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

