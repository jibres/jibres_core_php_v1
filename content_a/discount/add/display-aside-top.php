<?php
$html = '';

$discount_id = \dash\request::get('id');

/*=======================================
=            Link to factors            =
=======================================*/
if($discount_id)
{
	$filter_factor = \dash\url::here(). '/order?discount_id='. $discount_id;
	$title = T_("Show factors by this discount");
	$html .= "<a href='$filter_factor' data-direct>$title</a>";
}


/*=====  End of Link to factors  ======*/


echo $html;
?>