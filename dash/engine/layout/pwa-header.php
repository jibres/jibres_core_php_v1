 <nav class="f">
  <div class="c4 back"><?php
if(\dash\data::page_backLink() && \dash\data::page_backText())
{
	echo "<a href='". \dash\data::page_backLink(). "'>". \dash\data::page_backText(). "</a>";
}
?></div>
  <div class="c4 title"><?php echo \dash\data::page_title(); ?></div>
  <div class="c4 action"><?php
if(\dash\data::page_btnLink() && \dash\data::page_btnText())
{
	if(\dash\data::page_btnTextIcon())
	{
		echo "<a href='". \dash\data::page_btnLink(). "'><i class='sf-". \dash\data::page_btnTextIcon(). "'></i></a>";
	}
	else
	{
		echo "<a href='". \dash\data::page_btnLink(). "'>". \dash\data::page_btnText(). "</a>";
	}
}
?></div>
 </nav>