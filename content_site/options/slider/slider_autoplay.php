<?php
namespace content_site\options\slider;


class slider_autoplay
{

	public static function this_range()
	{
		return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	}


	public static function validator($_data)
	{
		$data = \dash\validate::string_50($_data);

		if(!in_array($data, self::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function admin_html()
	{
		$name = 'slider_autoplay';

		$default = \content_site\section\view::get_current_index_detail('slider_autoplay');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= '<div class="pb-2">';
			{
				$html .= '<label for="'.$name.'">'.T_("Autoplay delay").'</label>';
				$html .= '<input type="text" name="opt_'.$name.'" id="'.$name.'" data-rangeSlider data-skin="round" value="'.array_search($default, self::this_range()).'" data-values="'. implode(',', self::this_range()). '">';
			}
			$html .= '</div>';
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>