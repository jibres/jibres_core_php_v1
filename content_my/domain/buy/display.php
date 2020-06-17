<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php
if(\dash\data::myDomain())
{
	if(\dash\validate::ir_domain(\dash\data::myDomain(), false))
	{
  		require_once ('display-settings.php');
	}
	else
	{
  		require_once ('display-settings-com.php');

	}
}
else
{
  require_once ('display-search.php');
}
?>
