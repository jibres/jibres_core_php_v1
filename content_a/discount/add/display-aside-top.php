<?php
$html = '';

$summary = \dash\data::discountSummary();
$discount_id = \dash\request::get('id');
$filter_factor = \dash\url::here(). '/order?discount_id='. $discount_id;

/*=======================================
=            Link to factors            =
=======================================*/
if($discount_id)
{
	$title = T_("Show factors by this discount");
	$html .= "<a class='btn-secondary outline' href='$filter_factor' data-direct>$title</a>";
}
/*=====  End of Link to factors  ======*/


if(a($summary, 'used'))
{
	$title = T_("Count used :val", ['val' => \dash\fit::number($summary['used'])]);
	$html .= "<a class='btn-secondary outline' href='$filter_factor' data-direct>$title</a>";

}

if(a($summary, 'lookup'))
{
	$title = T_("Count lookup :val", ['val' => \dash\fit::number($summary['lookup'])]);
	$html .= "<a class='btn-secondary outline' data-direct>$title</a>";

}



echo $html;
?>