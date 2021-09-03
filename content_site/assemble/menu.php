<?php
namespace content_site\assemble;


class menu
{

	public static function generate($_menu_id, $_class = null)
	{
		$html = '';

		$load_menu = \lib\app\menu\get::load_menu($_menu_id);

		if(is_array(a($load_menu, 'list')))
		{
			foreach ($load_menu['list'] as $key => $value)
			{
				$target = a($value, 'target') ? 'target="_blank"' : null;

				$html .= "<a href='$value[url]' $target class='$_class'>$value[title]</a>";
			}
		}

		return $html;
	}

}
?>