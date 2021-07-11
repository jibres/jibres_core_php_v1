<?php
namespace content_site\options;


class generate_radio_line
{

	public static function add_ul($_uniqueName, $_html_child)
	{
		$html = '';

		$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex fix items-center relative p-2 space-x-2 bg-gray-100 text-center rounded-lg font-bold text-blue-600 mb-3">';
		{
			$html .= $_html_child;
		}
		$html .= '</ul>';

		return $html;
	}


	public static function itemText($_name, $_value, $_text, $_checked = null)
	{
		$myId = $_name. '-'. $_value. '-id';

		$html = '';
		$html .= '<li class="filter-switch-item flex-1 relative">';
		{
			$html .= "<input type='radio' name='$_name' id='$myId' value='$_value' class='sr-only'";
			if($_checked)
			{
				$html .= ' checked';
			}
			$html .= '>';

			$html .= "<label for='$myId' class='block h-10 py-1 px-3 text-base text-gray-600 hover:text-gray-800 rounded-full shadow bg-white'>";
			$html .= $_text;
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}

}
?>