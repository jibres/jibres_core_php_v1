<?php
if(\dash\data::displayShowTagList())
{
  require_once('display-all-tag-list.php');
}
else
{
  require_once('display-one-tag.php');

}
?>
