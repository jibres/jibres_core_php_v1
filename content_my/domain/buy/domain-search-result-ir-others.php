<?php
$available = true;
echo '<div class="c pA5">';
    echo '<a class="stat x70';
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


        // f
        echo '<h3>';
        if($value['available'])
        {
            echo T_("Available");
        }
        else
        {
            echo T_('Unavailable');
        }
        echo '</h3>';

        echo '<div class="val">';
        if(isset($value['tld']))
        {
            echo '.'. $value['tld'];
        }
        echo '</div>';
    echo '</a>';
echo '</div>';
?>