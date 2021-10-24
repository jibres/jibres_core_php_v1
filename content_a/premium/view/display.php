<?php

$premiumDetail = \dash\data::premiumDetail();
$currency = \lib\store::currency();

$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
	$html .= '<form method="post" autocomplete="off" id="premiumadd">';
	{
		/*=====================================
		=            Premium                  =
		=====================================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= a($premiumDetail, 'title');
				$html .= '<br>';
				$html .= a($premiumDetail, 'description');

				$html .= '<br>';
				$html .= a($premiumDetail, 'price');

			}
			$html .= '</div>';

			$html .= '<footer>';
			{
				$html .= '<button class="btn-danger">'. T_("Buy"). '</button>';
			}
			$html .= '</footer>';

		}
		$html .= '</div>';
		/*=====  End of Premium  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>