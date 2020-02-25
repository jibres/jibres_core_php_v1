   <div class="result ltr"><?php
if(\dash\data::infoResult())
{
    foreach (\dash\data::infoResult() as $key => $value)
    {
        echo '<div class="msg minimal mB5';
        if(isset($value['available']))
        {
            if($value['available'])
            {
                echo " success2";
            }
            else
            {
                echo " danger2";
            }
        }
        echo '">';
            // f
            echo '<div class="f align-center pL10">';


                // cell1
                echo '<div class="c pA5 pR10-f">';
                if(isset($value['name']) && isset($value['tld']))
                {
                    echo '<span class="name">'. $value['name']. '</span>';
                    echo '<span class="tld txtB mL5">.'. $value['tld']. '</span>';
                }
                else
                {
                    echo $key;
                }
                if(isset($value['paperwork']))
                {
                    echo '<span class="badge light mL10">'. $value['paperwork']. '</span>';
                }
                echo '</div>';


                // cell2
                echo '<div class="cauto pA5 pR20-f">';
                if(isset($value['price']))
                {
                    if(isset($value['unit']))
                    {
                        echo '<span class="compact unit">'. $value['unit']. '</span>';
                    }
                    echo ' <span class="compact price">'. \dash\fit::number($value['price']). '</span>';
                }
                if(isset($value['compareAtPrice']))
                {
                    echo ' / <del class="compact compareAtPrice">'. \dash\fit::number($value['compareAtPrice']). '</del>';
                }
                echo '</div>';


                // cell3
                echo '<div class="cauto pA5">';
                if(isset($value['soon']) && $value['soon'])
                {
                    echo T_("Coming Soon");
                }
                else
                {
                    if(isset($value['available']))
                    {
                        if($value['available'])
                        {
                            echo '<a class="btn success" href="'. \dash\url::kingdom(). '/my/domain/buy/'. $key.'">'. T_("Let's Buy"). '</a>' ;
                        }
                        else
                        {
                            echo '<a class="btn light" target="_blank" href="'. \dash\url::kingdom(). '/whois/'. urlencode($key).'">'. T_("Whois taken?"). '</a>' ;
                        }
                    }
                    else
                    {
                        echo T_("Unavailable");
                    }
                }
                echo '</div>';


            echo '</div>';
        echo '</div>';
    }
}
?>
</div>
