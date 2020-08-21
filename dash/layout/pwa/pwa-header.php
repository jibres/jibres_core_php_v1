<?php
if(!\dash\face::disablePWA_Header())
{

  echo "<div class='pwa'>";
  if(\dash\data::back_link())
  {
  	echo "<a class='square back' href='". \dash\data::back_link(). "'></a>";
  }

  if(\dash\face::logoPWA())
  {
    echo '<img class="logo" alt="'. \dash\face::titlePWA(). '" src="'. \dash\face::logoPWA(). '">';
  }
  {
    echo "<div class='title'>";
    echo \dash\face::titlePWA();
    echo "</div>";
  }

  // help btn
  if(\dash\face::help())
  {
    echo "<a class='square help' href='". \dash\face::help(). "'></a>";
  }
  // search btn
  if(\dash\data::search_link())
  {
    if(!\dash\data::nosale())
    {
  	 echo "<a class='square search' href='". \dash\data::search_link(). "'></a>";
    }
  }
  // preview btn
  if(\dash\face::btnPreview())
  {
    echo "<a class='square preview' href='". \dash\face::btnPreview(). "'></a>";
  }
  // view btn
  if(\dash\face::btnView())
  {
    echo "<a class='square view' href='". \dash\face::btnView(). "'></a>";
  }
  // duplicate btn
  if(\dash\face::btnDuplicate())
  {
    echo "<a class='square duplicate' href='". \dash\face::btnDuplicate(). "'></a>";
  }
  // cart btn
  if(\dash\data::cart_link() !== null)
  {
  	echo "<a class='square cart' href='". \dash\url::kingdom(). "/cart' data-item='". \dash\data::cart_link(). "'></a>";
  }
  // add btn
  if(\dash\data::action_link() && (\dash\data::action_icon() || \dash\data::action_text()))
  {
    if(\dash\data::action_icon())
    {
      echo "<a class='square ". \dash\data::action_icon()."' href='". \dash\data::action_link(). "'></a>";
    }
    else
    {
      echo "<a class='action' href='". \dash\data::action_link(). "'>". \dash\data::action_text(). "</a>";
    }
  }
  // setting
  if(\dash\face::btnSetting())
  {
    echo "<a class='square setting' href='". \dash\face::btnSetting(). "'></a>";
  }
  // menu btn
  if(\dash\data::menu_link())
  {
  	echo "<div class='square menu'></div>";
  }
  // save btn
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
  // insert btn
  if(\dash\face::btnInsert())
  {
    echo '<button class="insert" form="';
    echo \dash\face::btnInsert();
    echo '"';
    if(\dash\face::btnInsertValue())
    {
      echo " name='submitall' value='". \dash\face::btnInsertValue(). "'";
    }
    echo '>';
    if(\dash\face::btnInsertText())
    {
      echo \dash\face::btnInsertText();
    }
    else
    {
      echo T_("Add");
    }
    echo "</button>";
  }

  echo "</div>";
}
?>