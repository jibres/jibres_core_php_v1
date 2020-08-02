<?php
if(!\dash\face::disablePWA_Header())
{

  echo "<div class='pwa'>";
  if(\dash\data::back_link())
  {
  	echo "<a class='square back' href='". \dash\data::back_link(). "'></a>";
  }

  {
    echo "<div class='title'>";
    echo \dash\face::titlePWA();
    echo "</div>";
  }

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
  // add preview btn
  if(\dash\face::btnPreview())
  {
    echo "<a class='square preview' href='". \dash\face::btnPreview(). "'></a>";
  }
  // add view btn
  if(\dash\face::btnView())
  {
    echo "<a class='square view' href='". \dash\face::btnView(). "'></a>";
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
  // add save btn
  if(\dash\face::btnSave())
  {
    echo '<button class="save" form="';
    echo \dash\face::btnSave();
    echo '"';
    if(\dash\face::btnSaveValue())
    {
      echo " name='submitall' value='". \dash\face::btnSaveValue(). "'";
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
  // add add btn
  if(\dash\face::btnAdd())
  {
    echo '<button class="add" form="';
    echo \dash\face::btnAdd();
    echo '"';
    if(\dash\face::btnAddValue())
    {
      echo " name='submitall' value='". \dash\face::btnAddValue(). "'";
    }
    echo '>';
    if(\dash\face::btnAddText())
    {
      echo \dash\face::btnAddText();
    }
    else
    {
      echo T_("Add");
    }
    echo "</button>";
  }
  if(\dash\data::action_link() && \dash\data::action_text())
  {
    echo "<div class='action'>";
  	if(\dash\data::action_icon())
  	{
  		echo "<a href='". \dash\data::action_link(). "'><i class='sf-". \dash\data::action_icon(). "'></i></a>";
  	}
  	else
  	{
  		echo "<a href='". \dash\data::action_link(). "'>". \dash\data::action_text(). "</a>";
  	}
    echo "</div>";
  }

  echo "</div>";
}
?>