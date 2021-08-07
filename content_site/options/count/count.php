<?php
namespace content_site\options\count;


trait count
{


	public static function validator($_data)
	{
		$data = \dash\validate::int($_data);

		if(!in_array($data, self::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function db_key()
	{
		return 'count';
	}


	public static function title()
	{
		return T_("Count Show");
	}


	public static function admin_html()
	{
		$option_name = self::option_name();

		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<div class="pb-2">';
			{
				$html .= '<label for="'.$option_name.'">'. self::title(). '</label>';
				$html .= '<input type="text" name="opt_'.$option_name.'" id="'.$option_name.'" data-rangeSlider data-skin="round" value="'.array_search($default, self::this_range()).'" data-values="'. implode(',', self::this_range()). '">';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>