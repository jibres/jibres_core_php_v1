<?php
    echo '<div class="box result ltr mB25-f mLR5-f">';
    echo '<div class="msg fs12 mB0';
    if(isset($value['available']))
    {
        if($value['available'])
        {
            echo "";
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
            echo '<div class="c s12 pA5 pR10-f">';
            if(isset($value['name']) && isset($value['tld']))
            {
                echo '<span class="name txtB fs20">'. $value['name']. '</span>';
                echo '<span class="tld mL5 fs14">.'. $value['tld']. '</span>';
            }
            else
            {
                echo $key;
            }

            if(isset($value['available']) && !$value['available'] && array_key_exists('domain_restricted', $value) && !$value['domain_restricted'] && array_key_exists('domain_name_valid', $value) && $value['domain_name_valid'] !== false)
            {
                echo '<a class="btn hauto link mLR10 fs08"  href="'. \dash\url::this(). '/renew?domain='. urlencode($key).'">'. T_("If is your domain you can renew it"). '</a>' ;
            }

            if(isset($value['paperwork']))
            {
                echo '<span class="badge light mL10">'. $value['paperwork']. '</span>';
            }
            echo '</div>';

            if(isset($value['available']) && $value['available'])
            {

                // cell2
                echo '<div class="cauto pA5 pR20-f txtR">';
                    echo '<div>';
                        if(isset($value['price_1year']))
                        {
                            if(isset($value['unit']))
                            {
                                echo '<span class="compact unit">'. $value['unit']. '</span>';
                            }
                            echo ' <span class="compact price">'. \dash\fit::number($value['price_1year']). '</span>';
                        }
                        if(isset($value['compareAtPrice_1year']))
                        {
                            echo ' / <del class="compact compareAtPrice">'. \dash\fit::number($value['compareAtPrice_1year']). '</del>';
                        }
                        echo '<span class="compact period pLR10">'. T_("1 Year"). '</span>';
                    echo '</div>';

                    echo '<div>';
                        if(isset($value['price_5year']))
                        {
                            if(isset($value['unit']))
                            {
                                echo '<span class="compact unit">'. $value['unit']. '</span>';
                            }
                            echo ' <span class="compact price">'. \dash\fit::number($value['price_5year']). '</span>';
                        }
                        if(isset($value['compareAtPrice_5year']))
                        {
                            echo ' / <del class="compact compareAtPrice">'. \dash\fit::number($value['compareAtPrice_5year']). '</del>';
                        }
                        echo '<span class="compact period pLR10">'. T_("5 Year"). '</span>';
                    echo '</div>';
                echo '</div>';

            }

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
                        echo '<a class="btn success lg" href="'. \dash\url::kingdom(). '/my/domain/buy/'. $key.'">'. T_("Let's Buy"). '</a>' ;
                    }
                    else
                    {
                        if(array_key_exists('domain_restricted', $value) && $value['domain_restricted'])
                        {
                            echo '<div class="btn light">'. T_("Domain restricted for register"). '</div>' ;
                        }
                        elseif(array_key_exists('domain_name_valid', $value) && $value['domain_name_valid'] === false)
                        {
                            echo '<div class="btn light">'. T_("Domain name is not valid"). '</div>' ;
                        }
                        else
                        {
                            echo '<a class="btn light" target="_blank" href="'. \dash\url::kingdom(). '/whois/'. urlencode($key).'">'. T_("Whois taken?"). '</a>' ;
                        }
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
    echo '</div>';
?>