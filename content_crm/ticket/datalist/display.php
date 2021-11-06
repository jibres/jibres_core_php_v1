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
          echo \dash\utility\icon::svg('Patch check', 'bootstrap', null, 'text-green-500');
        }
        else
        {
          echo \dash\utility\icon::svg('Patch exclamation fill', 'bootstrap', null, 'text-blue-500');
        }

        echo a($value, 'statusIcon');

        if(a($value, 'subtype') === 'bug')
        {
          echo '<div class="value">'. T_("Bug report"). ' '. $value['id']. '</div>';
        }
        else
        {
          echo '<div class="value">'. T_("Ticket"). ' '. $value['id']. '</div>';
        }



        echo '<div class="key">'. a($value, 'title'). '</div>';

        if(!\dash\temp::get('customer_mode'))
        {
          echo '<div class="value s0">'. a($value, 'displayname'). '</div>';
          echo '<div class="value"><img class="avatar" alt="'. a($value, 'displayname'). '" src="'. \dash\fit::img(a($value, 'avatar')). '"></div>';
        }

        echo '<time class="value" datetime="'. a($value, 'datecreated'). '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
        echo "<i data-count='". \dash\fit::number(a($value, 'plus')). "'>";
        echo \dash\utility\icon::svg('chat-quote', 'bootstrap');
        echo "</i>";
      }
      echo '</a>';
    }
    echo '</li>';
  }
  echo '</ul>';
echo '</nav>';
\dash\utility\pagination::html();
?>
