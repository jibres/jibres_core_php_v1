<?php
echo '<nav class="items long">';
  echo '<ul>';
  foreach (\dash\data::dataTable() as $key => $value)
  {
    echo '<li>';
    {
      echo '<a class="f item" href="'. \dash\url::this(). '/view?id='. $value['id']. '">';
      {
        if(a($value, 'solved'))
        {
          echo '<i class="sf-heart ok"></i>';
        }
        else
        {
          echo '<i class="sf-heart-o"></i>';
        }

        echo '<i class="sf-'. a($value, 'statuclass'). '"></i>';

        echo '<div class="value">'. T_("Ticket"). ' #'. $value['id']. '</div>';

        echo '<div class="key">'. a($value, 'title'). '</div>';

        if(a($value, 'plus'))
        {
          echo "<i class='sf-retweet' data-count='". \dash\fit::number(a($value, 'plus')). "'></i>";
          // echo '<div class="value">';
          // echo ' <span class="badge rounded light s0"> <i class="sf-refresh"></i> '. \dash\fit::number(a($value, 'plus')). '</span>';
          // echo '</div>';
        }


        echo '<div class="value s0">'. a($value, 'displayname'). '</div>';
        echo '<div class="value"><img class="avatar" alt="'. a($value, 'displayname'). '" src="'. a($value, 'avatar'). '"></div>';
        echo '<time class="value" datetime="'. a($value, 'datecreated'). '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
      }
      echo '</a>';
    }
    echo '</li>';
  }
  echo '</ul>';
echo '</nav>';
\dash\utility\pagination::html();
?>
