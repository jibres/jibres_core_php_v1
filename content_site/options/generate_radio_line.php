<?php
namespace content_site\options;


class generate_radio_line
{
	public static function html($_name = null, $_type = null)
	{
		$_name = 'sample1';
		$_uniqueName = 'quick_'. $_name;


		$html = '';
		$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex fix items-center relative p-2 space-x-2 bg-gray-100 text-center rounded-lg font-bold text-blue-600 mb-3">';
		{
			$html .= self::itemText($_uniqueName, $_uniqueName.'-s', 'S');
			$html .= self::itemText($_uniqueName, $_uniqueName.'-m', 'M', true);
			$html .= self::itemText($_uniqueName, $_uniqueName.'-l', 'L');
			$html .= self::itemText($_uniqueName, $_uniqueName.'-more', '...');
		}
		$html .= '</ul>';


		return $html;
	}


	private static function itemText($_name, $_id, $_text, $_checked = null)
	{
		$html = '';
		$html .= '<li class="filter-switch-item flex-1 relative">';
		{
			$checkedBg = null;
			$html .= '<input type="radio" name="'. $_name. '" id="'. $_id. '-0" class="sr-only"';
			if($_checked)
			{
				$checkedBg = ' bg-white';
				$html .= ' checked';
			}
			$html .= '>';

			$html .= '<label for="'. $_id. '-0" class="block h-10 py-1 px-3 text-sm leading-6 text-gray-600 hover:text-gray-800 rounded-full shadow'. $checkedBg. '">';
			$html .= $_text;
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}

}
?>