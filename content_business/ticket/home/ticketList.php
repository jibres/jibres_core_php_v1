<?php
if(\dash\data::listEngine())
{
  if(\dash\data::dataTable())
  {
      require_once(core. 'layout/tools/display-search-bar.php');

      echo '<nav class="items long">';
        echo '<ul>';
        foreach (\dash\data::dataTable() as $key => $value)
        {
          echo '<li>';
          echo '<a class="f" href="'. \dash\url::that(). '/view?id='. $value['id']. '">';
              echo '<div class="key">';
              {

                echo '<span class="mRa5">'. T_("Ticket"). ' <span class="fc-fb">#'. $value['id']. '</span></span> ';
                if(a($value, 'title'))
                {
                  echo  ' <b>'. a($value, 'title'). '</b>';
                }
              }
              echo '</div>';
              echo '<div class="value">'. T_($value['status']). '</div>';
              echo '<div class="value">'. \dash\fit::date_time($value['datecreated']). '</div>';

          echo '</a>';
          echo '</li>';

        }
        echo '</ul>';
      echo '</nav>';
      \dash\utility\pagination::html();

  }
  else
  {
    if(\dash\data::isFiltered() || \dash\request::get('q'))
    {
      require_once(core. 'layout/tools/display-search-bar.php');
      require_once(core. 'layout/tools/display-search-empty.php');
    }
    else
    {
      require_once(core. 'layout/tools/display-start.php');
    }
  }
}
?>