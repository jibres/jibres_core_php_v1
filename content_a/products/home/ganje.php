<?php
$html = '';

$html .= '<div class="lg:w-2/4 w-11/12 m-auto">';
{
	if(\dash\data::ganjeSearch())
	{
		foreach (\dash\data::ganjeSearch() as $key => $value)
		{
			$html .= \lib\app\product\ganje::product_html($value);
		}
	}

}
$html .= '</div>';

echo $html;
?>