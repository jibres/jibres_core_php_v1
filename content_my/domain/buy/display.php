<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php
if(\dash\data::myDomain())
{
  require_once ('display-settings.php');
}
else
{
  require_once ('display-search.php');
}
?>
