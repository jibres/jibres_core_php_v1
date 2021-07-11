<?php
namespace content_site\options;


class generate_radio_line
{
	public static function html($_name = null, $_type = null)
	{
		$_name = 'sample1';
		$_uniqueName = 'quick_'. $_name;


		$html = '';
		$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex items-center relative p-1.5 space-x-4 bg-gray-200 rounded-md font-bold text-blue-600 mb-3">';
		{
			$html .= self::itemText($_uniqueName, $_uniqueName.'-s', 'S');
			$html .= self::itemText($_uniqueName, $_uniqueName.'-m', 'M');
			$html .= self::itemText($_uniqueName, $_uniqueName.'-l', 'L');
		}
		$html .= '</ul>';


		return $html;
	}


	private static function itemText($_name, $_id, $_text)
	{
		$html = '';
		$html .= '<li class="filter-switch-item flex relative h-10 bg-gray-300x">';
		{
			$html .= '<input type="radio" name="'. $_name. '" id="'. $_id. '-0" class="sr-only" checked>';
			$html .= '<label for="'. $_id. '-0" class="h-10 py-1 px-3 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">';
			$html .= $_text;
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}

}
?>