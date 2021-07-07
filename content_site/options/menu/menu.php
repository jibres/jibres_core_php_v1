<?php
namespace content_site\options\menu;


trait menu
{
	private static function enum()
	{
		$menu = \lib\app\menu\get::list_all_menu();

		if(!is_array($menu))
		{
			$menu = [];
		}

		$enum = array_column($menu, 'id');

		return $enum;
	}


	public static function validator($_data)
	{
		if(!$_data)
		{
			return null;
		}

		$data = \dash\validate::enum($_data, true, ['enum' => self::enum(), 'field_title' => T_('Menu')]);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{

		$header_menu_key = self::get_menu_name();

		$default = \content_site\section\view::get_current_index_detail($header_menu_key);


		$title           = T_("Menu");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='menu'>$title</label>";

			$menu = \lib\app\menu\get::list_all_menu();

			if($menu)
			{


				$html .= '<select name="'. $header_menu_key. '" id="idmenu_'. $header_menu_key. '" class="select22" data-placeholder="'. T_("Choose one menu"). '">';
				{
					if($default)
					{
						$html .= '<option value="0">'. T_("Without menu"). '</option>';
					}
					else
					{
						$html .= '<option value="">'. T_("Choose one menu"). '</option>';
					}

					foreach ($menu as $key => $value)
					{

						$html .= '<option value="'. a($value, 'id'). '"';
						if($default == a($value, 'id'))
						{
							$html .= ' selected';
						}
						$html .= '>';
						$html .= a($value, 'title'). '</option>';
					}
				}
				$html .= '</select>';

			}
			else
			{
				$html .= '<a class="btn primary" href="'. \dash\url::kingdom(). '/a/setting/menu/add">'. T_("Add new menu"). '</a>';
			}


			if($menu)
			{
				if($default)
				{
					$html .= '<a href="'. \dash\url::kingdom(). '/a/setting/menu/roster?id='. $default. '" class="btn link">'. T_("Edit menu :val", ['val' => null]). '</a>';
				}
				$html .= '<a href="'. \dash\url::kingdom() . '/a/setting/menu/add" class="btn link">'. T_("Add new menu"). '</a>';
			}

		}
 		$html .= '</form>';

		return $html;
	}

}
?>