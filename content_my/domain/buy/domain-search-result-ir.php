<?php
$master_domain = \dash\get::index($master, 'full');

    echo '<div class="box result ltr mB25-f mLR5-f">';
    echo '<div class="msg fs12 mB0';
    if(isset($master['available']))
    {
        if($master['available'])
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
            if(isset($master['name']) && isset($master['tld']))
            {
                echo '<span class="name txtB fs20">'. $master['name']. '</span>';
                echo '<span class="tld mL5 fs14">.'. $master['tld']. '</span>';
            }
            else
            {
                echo $master_domain;
            }

            if(isset($master['available']) && !$master['available'] && array_key_exists('domain_restricted', $master) && !$master['domain_restricted'] && array_key_exists('domain_name_valid', $master) && $master['domain_name_valid'] !== false)
            {
                echo '<a class="btn hauto link mLR10 fs08"  href="'. \dash\url::this(). '/renew?domain='. urlencode($master_domain).'">'. T_("If is your domain you can renew it"). '</a>' ;
            }

            if(isset($master['paperwork']))
            {
                echo '<span class="badge light mL10">'. $master['paperwork']. '</span>';
            }
            echo '</div>';

            if(isset($master['available']) && $master['available'])
            {

                // cell2
                echo '<div class="cauto pA5 pR20-f txtR">';
                    echo '<div>';
                        if(isset($master['price_1year']))
                        {
                            if(isset($master['unit']))
                            {
                                echo '<span class="compact unit">'. $master['unit']. '</span>';
                            }
                            echo ' <span class="compact price">'. \dash\fit::number($master['price_1year']). '</span>';
                        }
                        if(isset($master['compareAtPrice_1year']))
                        {
                            echo ' / <del class="compact compareAtPrice">'. \dash\fit::number($master['compareAtPrice_1year']). '</del>';
                        }
                        echo '<span class="compact period pLR10">'. T_("1 Year"). '</span>';
                    echo '</div>';

                    echo '<div>';
                        if(isset($master['price_5year']))
                        {
                            if(isset($master['unit']))
                            {
                                echo '<span class="compact unit">'. $master['unit']. '</span>';
                            }
                            echo ' <span class="compact price">'. \dash\fit::number($master['price_5year']). '</span>';
                        }
                        if(isset($master['compareAtPrice_5year']))
                        {
                            echo ' / <del class="compact compareAtPrice">'. \dash\fit::number($master['compareAtPrice_5year']). '</del>';
                        }
                        echo '<span class="compact period pLR10">'. T_("5 Year"). '</span>';
                    echo '</div>';
                echo '</div>';

            }

            // cell3
            echo '<div class="cauto pA5">';
            if(isset($master['soon']) && $master['soon'])
            {
                echo T_("Coming Soon");
            }
            else
            {
                if(isset($master['available']))
                {
                    if($master['available'])
                    {
                        echo '<a class="btn success lg" href="'. \dash\url::kingdom(). '/my/domain/buy/'. $master_domain.'">'. T_("Let's Buy"). '</a>' ;
                    }
                    else
                    {
                        if(array_key_exists('domain_restricted', $master) && $master['domain_restricted'])
                        {
                            echo '<div class="btn light">'. T_("Domain restricted for register"). '</div>' ;
                        }
                        elseif(array_key_exists('domain_name_valid', $master) && $master['domain_name_valid'] === false)
                        {
                            echo '<div class="btn light">'. T_("Domain name is not valid"). '</div>' ;
                        }
                        else
                        {
                            echo '<a class="btn light" target="_blank" href="'. \dash\url::kingdom(). '/whois/'. urlencode($master_domain).'">'. T_("Whois taken?"). '</a>' ;
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