<?php
echo '<div class="c pA5">';
    echo '<a class="stat';
        if(isset($value['available']))
        {
            if($value['available'])
            {
                echo " available";
            }
            else
            {
                echo " unavailable";
            }
        }
        echo '"';
        echo ' href="'. \dash\url::this(). '/buy/'. $key. '"';
        if(isset($value['paperwork']))
        {
            echo ' title="'. $value['paperwork']. '"';
        }
        echo '>';


        // f
        echo '<h3>';
        if(isset($value['name']))
        {
            echo $value['name'];
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