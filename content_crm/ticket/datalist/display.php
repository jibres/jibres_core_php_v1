<?php
echo '<nav class="items long">';
  echo '<ul>';
  foreach (\dash\data::dataTable() as $key => $value)
  {
    echo '<li>';
    echo '<a class="f" href="'. \dash\url::this(). '/view?id='. $value['id']. '">';
        echo '<div class="key">';
        {
          if(a($value, 'solved'))
          {
            $fc = 'fc-green';
          }
          else
          {
            $fc = 'fc-fb';
          }

          echo '<span class="mRa5">'. T_("Ticket"). ' <span class="'.$fc.'">#'. $value['id']. '</span></span> ';

          if(a($value, 'plus'))
          {
            echo ' <span class="badge rounded light s0"> <i class="sf-refresh"></i> '. \dash\fit::number(a($value, 'plus')). '</span>';
          }


          if(a($value, 'title'))
          {
            echo  ' <b>'. a($value, 'title'). '</b>';
          }
        }
        echo '</div>';
        echo '<div class="value">'. \dash\fit::date_time($value['datecreated']). '</div>';
        echo '<div class="value s0">'. a($value, 'displayname'). '</div>';
        echo '<div class="value"><img class="avatar" alt="'. a($value, 'displayname'). '" src="'. a($value, 'avatar'). '"></div>';

    echo '</a>';
    echo '</li>';

  }
  echo '</ul>';
echo '</nav>';
\dash\utility\pagination::html();
?>
