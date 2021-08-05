<?php
namespace content_site\options;


class generate_radio_line
{

	public static function add_ul($_uniqueName, $_html_child)
	{
		$html = '';

		$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex fix items-center relative p-2 space-x-2 bg-gray-100 text-center font-mono rounded-lg font-bold text-blue-600 mb-3">';
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

			$html .= "<label for='$myId' class='block pt-2 px-3 h-12 text-md text-gray-600 hover:text-gray-800 rounded-lg shadow bg-white transition'>";
			if($_value === 'more')
			{
				$html .= '<svg class="mt-1 block mx-auto opacity-70" height="22" viewBox="0 0 22 22" width="22" xmlns="http://www.w3.org/2000/svg"><path d="M12.8 11a1.8 1.8 0 11-3.6 0 1.8 1.8 0 013.6 0zM4.8 11a1.8 1.8 0 11-3.6 0 1.8 1.8 0 013.6 0zM19 12.8a1.8 1.8 0 100-3.6 1.8 1.8 0 000 3.6z"></path></svg>';
			}
			else
			{
				$html .= $_text;
			}
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}

}
?>