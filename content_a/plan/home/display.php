<?php
$html = '';
$planList = \dash\data::planList();

foreach ($planList as $plan)
{
    $html .= '<div class="box">';
    {
        $html .= '<div class="">';
        {
            $html .= T_("Price");
            $html .= \dash\fit::number($plan['price']);
            $html .= $plan['currencyName'];
        }
        $html .= '</div>';

        $html .= "<div class='btn-primary mx-2' data-ajaxify data-data='". json_encode(['plan' => $plan['name']]). "'>". $plan['title']. '</div>';
    }
    $html .= '</div>';

}
echo $html;
?>