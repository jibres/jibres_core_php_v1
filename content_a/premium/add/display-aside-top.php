<?php
$html = '';

$discountSummary = \dash\data::discountSummary();
$discount_id = \dash\request::get('id');
$filter_factor = \dash\url::here(). '/order?discount_id='. $discount_id;

if(\dash\data::dataRow_code())
{
	$html .= '<h3>';
	{
		$html .= \dash\data::dataRow_code();
	}
	$html .= '</h3>';
}

if(a($discountSummary, 'summary'))
{
	$html .= '<ul class="list-disc pl-5 pr-5 mb-5">';
	{
		foreach ($discountSummary['summary'] as $key => $value)
		{
			$html .= '<li>';
			{
				$html .= $value;
			}
			$html .= '</li>';
		}
	}
	$html .= '</ul>';
}


if($discount_id)
{
	$title = T_("Show factors by this discount");
	$html .= "<a class='link-primary outline' href='$filter_factor' data-direct>$title</a>";
}


echo $html;
?>