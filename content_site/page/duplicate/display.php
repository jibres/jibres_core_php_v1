<?php
$html = '';


$html .= '<form class="f justify-center" method="post" autocomplete="off">';
{

  $html .= '<div class="c6 s12">';
  {

    $html .= '<div class="box p-4">';
    {
    	$copyName = T_("Copy from"). ' '. \dash\data::currentPageDetail_title();

		$html .= '<h2>'. T_("Make a copy of this page"). '</h2>';

		$html .= '<div class="">';
		{
			$html .= '<label for="title">'. T_("New Title"). '<span class="text-red-800">*</span></label>';

			$html .= '<div class="input">';
			{
				$html .= '<input type="text" name="title" id="title" placeholder="'. $copyName. '" value="'. $copyName. '" maxlength="200" autofocus>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		$html .= '<div class="txtRa">';
		{
			$html .= '<button class="btn-success">'. T_("Copy"). '</button>';
		}
		$html .= '</div>';

    }
    $html .= '</div>';
  }
  $html .= '</div>';
}
$html .= '</form>';

$html .= '<div>';
{

}
$html .= '</div>';


echo $html;
?>