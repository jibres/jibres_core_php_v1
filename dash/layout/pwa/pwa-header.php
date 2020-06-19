
   <div class="back"><?php
if(\dash\data::back_link() && \dash\data::back_text())
{
	echo "<a href='". \dash\data::back_link(). "'>". \dash\data::back_text(). "</a>";
}
?></div>
   <div class="title"><?php echo \dash\face::title(); ?></div>
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