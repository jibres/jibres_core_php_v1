<?php

$pluginDetail = \dash\data::pluginDetail();
$currency = \lib\store::currency();


$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
	$html .= '<form method="post" autocomplete="off" id="pluginadd">';
	{
		/*=====================================
		=            plugin                  =
		=====================================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= a($pluginDetail, 'title');
				$html .= '<br>';
				$html .= a($pluginDetail, 'description');

				$html .= '<br>';
				$html .= 'Price';
				$html .= '<br>';

				if(a($pluginDetail, 'price') === 0)
				{
					$html .= '<div class="text-green-500">'.  T_("Free"). '</div>';
				}
				else
				{
					$html .= '<div class="">'.  \dash\fit::number(a($pluginDetail, 'price')). '</div>';
				}


			}
			$html .= '</div>';



		}
		$html .= '</div>';
		/*=====  End of plugin  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>