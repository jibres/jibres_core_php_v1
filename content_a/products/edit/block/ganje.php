<?php

return;
if(!\dash\data::productOnGanje())
{
    return;
}

$html = '';

$html .= '<div class="alert-info mt-2">';
{
    $html .= T_("Your product was exist in our ganje service. You can update your product detail by one click!");
}
$html .= '</div>';
$html .= \lib\app\product\ganje::product_html(\dash\data::productOnGanje(), true);

echo $html;
?>