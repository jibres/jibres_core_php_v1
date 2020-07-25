<?php
if(\dash\data::back_link())
{
	echo "<a class='square back' href='". \dash\data::back_link(). "'></a>";
}
?>
<div class="title"><?php echo \dash\face::titlePWA(); ?></div>
<?php
// add help btn
if(\dash\face::help())
{
  echo "<a class='square help' href='". \dash\face::help(). "'></a>";
}
// add search btn
if(\dash\data::search_link())
{
	echo "<a class='square search' href='". \dash\data::search_link(). "'></a>";
}
// add duplicate btn
if(\dash\face::btnDuplicate())
{
  echo "<a class='square duplicate' href='". \dash\face::btnDuplicate(). "'></a>";
}
// add cart btn
if(\dash\data::cart_link() !== null)
{
	echo "<a class='square cart' href='". \dash\url::kingdom(). "/cart' data-item='". \dash\data::cart_link(). "'></a>";
}
// add setting
if(\dash\face::btnSetting())
{
  echo "<a class='square setting' href='". \dash\face::btnSetting(). "'></a>";
}
// add menu btn
if(\dash\data::menu_link())
{
	echo "<div class='square menu'></div>";
}
?>
<div class="action"><?php
if(\dash\data::action_link() && \dash\data::action_text())
{
	if(\dash\data::action_icon())
	{
		echo "<a href='". \dash\data::action_link(). "'><i class='sf-". \dash\data::action_icon(). "'></i></a>";
	}
	else
	{
		echo "<a href='". \dash\data::action_link(). "'>". \dash\data::action_text(). "</a>";
	}
}
elseif(\dash\face::btnSave())
{
  echo '<button form="';
  echo \dash\face::btnSave();
  echo '"';
  if(\dash\face::btnSaveValue())
  {
    echo "name='submitall' value='". \dash\face::btnSaveValue(). "'";
  }
  echo '>';
  if(\dash\face::btnSaveText())
  {
    echo \dash\face::btnSaveText();
  }
  else
  {
    echo T_("Save");
  }
  echo "</button>";
}
?></div>
