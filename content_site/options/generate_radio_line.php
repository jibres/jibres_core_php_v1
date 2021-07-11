<?php
namespace content_site\options;


class generate_radio_line
{
	public static function height($_default)
	{
		$name = 'opt_height';

		$html = '';
		$html .= self::itemText($name, 'sm', 'S', (($_default === 'sm')? true : false));
		$html .= self::itemText($name, 'md', 'M', (($_default === 'md')? true : false));
		$html .= self::itemText($name, 'xl', 'L', (($_default === 'xl')? true : false));
		$html .= self::itemText($name, null , '...', (!in_array($_default, ['sm', 'md', 'xl']) ? true : false));

		$html = self::add_ul($name, $html);

		$data_response_hide = null;

		if(in_array($_default, ['sm', 'md', 'xl']))
		{
			$data_response_hide = 'data-response-hide';
		}

		$this_range = array_column(height::enum(), 'key');

		$html .= "<div data-response='$name' data-response-where-not='sm|md|xl' $data_response_hide>";
		$html .= '<input type="text" name="'.$name. '" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($_default, $this_range).'" value="'.array_search($_default, $this_range).'" data-values="'. implode(',', $this_range). '">';
		$html .= '</div>';

		return $html;

	}


	private static function add_ul($_uniqueName, $_html_child)
	{
		$html = '';

		$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex fix items-center relative p-2 space-x-2 bg-gray-100 text-center rounded-lg font-bold text-blue-600 mb-3">';
		{
			$html .= $_html_child;
		}
		$html .= '</ul>';

		return $html;
	}


	// public static function html($_name = null, $_type = null)
	// {
	// 	// $_name = 'sample1';
	// 	$_uniqueName = 'quick_'. $_name;
	// 	$html = '';
	// 	$html .= '<ul id="'. $_uniqueName. '" class="filter-switch flex fix items-center relative p-2 space-x-2 bg-gray-100 text-center rounded-lg font-bold text-blue-600 mb-3">';
	// 	{
	// 		$html .= self::itemText($_uniqueName, $_uniqueName.'-s', 'S');
	// 		$html .= self::itemText($_uniqueName, $_uniqueName.'-m', 'M', true);
	// 		$html .= self::itemText($_uniqueName, $_uniqueName.'-l', 'L');
	// 		$html .= self::itemText($_uniqueName, $_uniqueName.'-more', '...');
	// 	}
	//  $html .= '</ul>';
	//  return $html;
	// }


	private static function itemText($_name, $_value, $_text, $_checked = null)
	{
		$myId = $_name. '-'. $_value. '-id';

		$html = '';
		$html .= '<li class="filter-switch-item flex-1 relative">';
		{
			$checkedBg = null;
			$html .= "<input type='radio' name='$_name' id='$myId' value='$_value' class='sr-only'";
			if($_checked)
			{
				$checkedBg = ' bg-white';
				$html .= ' checked';
			}
			$html .= '>';

			$html .= "<label for='$myId' class='block h-10 py-1 px-3 text-sm leading-6 text-gray-600 hover:text-gray-800 rounded-full shadow $checkedBg'>";
			$html .= $_text;
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}

}
?>