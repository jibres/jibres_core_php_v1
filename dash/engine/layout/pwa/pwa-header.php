 <nav class="f">
  <div class="c4 back"><?php
if(\dash\data::back_link() && \dash\data::back_text())
{
	echo "<a href='". \dash\data::back_link(). "'>". \dash\data::back_text(). "</a>";
}
?></div>
  <div class="c4 title"><?php echo \dash\data::page_title(); ?></div>
  <div class="c4 action"><?php
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
?></div>
 </nav>