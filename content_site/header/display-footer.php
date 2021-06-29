<?php
/**
 * btn change header
 */
if(!\dash\data::inChangeHeaderFooter())
{
	$link_change_header = \dash\url::this(). '/change'. \dash\request::full_get();

	$html = '';
	$html .= '<div class="row w-full">';
	{
		$html .= '<div class="cauto">';
		{
			$html .= "<a href='$link_change_header' tabindex=0 class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 hover:text-red-500 focus:text-red-600 active:text-red-700 transition p-3 rounded-lg'>";
			{
				$html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Exchange'). '">';
				$html .= '<span class="inline-block align-middle ps-2">'. T_("Change header").'<span>';
			}
			$html .= '</a>';
		}
		$html .= '</div>';

		$html .= '<div class="c"></div>';
		$html .= "<div class='cauto os' >";
		$html .= '</div>';
	}
	$html .= '</div>';

	echo $html;
}

require_once(root. 'content_site/section/display-footer.php');

?>