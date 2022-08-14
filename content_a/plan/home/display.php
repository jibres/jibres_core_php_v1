<?php
$html = '';
$planList = \dash\data::planList();

foreach ($planList as $plan)
{
    $html .= "<div class='btn-primary mx-2' data-ajaxify data-data='". json_encode(['plan' => $plan['name']]). "'>". $plan['title']. '</div>';
}
echo $html;
?>