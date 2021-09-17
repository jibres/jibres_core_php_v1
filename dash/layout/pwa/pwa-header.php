<?php
if(!\dash\face::disablePWA_Header())
{

  echo "<div class='pwa'>";
  if(\dash\data::back_link())
  {
    echo "<a class='square minor back' href='". \dash\data::back_link(). "'>";
    {
      if(\dash\language::dir() === 'rtl')
      {
        echo \dash\utility\icon::svg('Chevron Right', 'minor');
      }
      else
      {
        echo \dash\utility\icon::svg('Chevron Left', 'minor');
      }
    }
  	echo "</a>";
  }

  if(\dash\face::logoPWA())
  {
    if(\dash\data::global_env() === 'Jibres')
    {
      echo '<svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1700 1700"><defs><style>  .cls-1{fill:#c80a5a;}.cls-2{fill:#fff;}</style></defs><circle class="cls-1" cx="850" cy="850" r="750"/><path class="cls-2" d="M1259.8 588.9v400h-800v-400h-100v400a100 100 0 0 0 100 100h800a100 100 0 0 0 100-100v-400Z"/></svg>';
    }
    else
    {
      echo '<img class="logo" alt="'. \dash\face::titlePWA(). '" src="'. \dash\face::logoPWA(). '">';
    }
  }
  {
    echo "<div class='title'>";
    echo \dash\face::titlePWA();
    echo "</div>";
  }

  // help btn
  if(\dash\face::help())
  {
    echo "<a class='square help' href='". \dash\face::help(). "'>";
    echo \dash\utility\icon::svg('Question Mark');
    echo '</a>';
  }
  // search btn
  if(\dash\data::search_link())
  {
    if(!\dash\data::nosale())
    {
      echo "<a class='square search' href='". \dash\data::search_link(). "'>";
      echo \dash\utility\icon::svg('Search');
      echo '</a>';
    }
  }
  // preview btn
  if(\dash\face::btnPreview())
  {
    echo "<a class='square preview' href='". \dash\face::btnPreview(). "'>";
    echo \dash\utility\icon::svg('Live View');
    echo '</a>';
  }
  // view btn
  if(\dash\face::btnView())
  {
    echo "<a class='square view' href='". \dash\face::btnView(). "'>";
    echo \dash\utility\icon::svg('Data Visualization');
    echo '</a>';
  }
  // duplicate btn
  if(\dash\face::btnDuplicate())
  {
    echo "<a class='square minor duplicate' href='". \dash\face::btnDuplicate(). "'>";
    echo \dash\utility\icon::svg('Duplicate', 'minor');
    echo '</a>';
  }

  // if(\dash\face::btnPrint())
  // {
  //   echo "<a class='square print' data-exec='print'>";
  //   echo \dash\utility\icon::svg('Print');
  //   echo '</a>';
  // }

  // cart btn
  if(\dash\data::cart_link() !== null)
  {
  	echo "<a class='square cart' href='". \dash\url::kingdom(). "/cart' data-item='". \dash\data::cart_link(). "'>";
    echo \dash\utility\icon::svg('Cart');
    echo '</a>';
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
    echo "<a class='square setting' href='". \dash\face::btnSetting(). "'>";
    // echo \dash\utility\icon::svg('Settings');
    echo \dash\utility\icon::svg('Tools');
    echo '</a>';
  }
  // menu btn
  if(\dash\data::menu_link())
  {
  	echo "<div class='square menu'>";
    echo \dash\utility\icon::svg('Mobile Vertical Dots');
    echo '</div>';
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
  // menu btn
  if(\dash\data::hamburger())
  {
    echo "<div class='square hamburger'>";
    {
      echo \dash\utility\icon::svg('Mobile Hamburger');
    }
    echo "</div>";
  }
  echo "</div>";
}
?>