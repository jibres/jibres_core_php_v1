<?php
if(\dash\data::back_link())
{
	echo "<a class='square back' href='". \dash\data::back_link(). "'></a>";
}
?>
<div class="title"><?php echo \dash\face::titlePWA(); ?></div>
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
	echo "<button form='". \dash\face::btnSave(). "'>". T_("Save"). "</button>";
}
?></div>
<?php
// add search btn
if(\dash\data::search_link() or 1)
{
	echo "<a class='square search' href='". \dash\data::search_link(). "'></a>";
}
// add menu btn
if(\dash\data::menu_link() or 1)
{
	echo "<div class='square menu'></div>";
}
?>