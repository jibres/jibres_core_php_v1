<?php
$available = true;
echo '<li>';
    echo '<a class="f';
        if(isset($value['available']))
        {
            if($value['available'])
            {
                echo " available";
            }
            else
            {
                $available = false;
                echo " unavailable";
            }
        }
        echo '"';

        if($available)
        {
            echo ' href="'. \dash\url::this(). '/buy/'. $key. '"';
            if(isset($value['paperwork']))
            {
                echo ' title="'. $value['paperwork']. '"';
            }
        }
        echo '>';



        echo '<div class="key">';
        if(isset($value['tld']))
        {
            echo '.'. $value['tld'];
        }
        echo '</div>';

        // f
        echo '<div class="value">';
        if($value['available'])
        {
            echo T_("Available");
        }
        else
        {
            echo T_('Unavailable');
        }
        echo '</div>';
        echo '<div class="go';
        if($available)
        {
            echo "";
        }
        echo '">';
        echo '</div>';
    echo '</a>';
echo '</li>';
?>