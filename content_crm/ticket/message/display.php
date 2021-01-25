<?php
echo '<nav class="items long">';
  echo '<ul>';
  foreach (\dash\data::dataTable() as $key => $value)
  {
    $master_id = a($value, 'parent') ? $value['parent'] : $value['id'];
    echo '<li>';
    echo '<a class="f" href="'. \dash\url::this(). '/view?id='. $master_id. '">';
        echo '<div class="key">';
        {

          echo '<span class="mRa5">'. T_("Ticket"). ' <span class="fc-fb">#'. $master_id. '</span></span> ';

          if(a($value, 'title'))
          {
            echo  ' <b>'. a($value, 'title'). '</b> ';
          }

          echo '<span>'. strip_tags($value['content']). '</span>';
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
