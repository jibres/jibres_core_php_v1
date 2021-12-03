<?php
namespace content_site\options\background;


class background_effect
{


	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none',   'title' => T_("None"),];
		$enum[] = ['key' => 'mesh',   'title' => T_("Mesh"),];
		$enum[] = ['key' => 'dark',   'title' => T_("Dark"),];
		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Effect')]);
		return $data;
	}



	public static function default()
	{
		return 'md';
	}


	public static function class_name($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
				{
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
				}
			}
		}
	}

	public static function html($_key)
	{
		$style = '';

		switch ($_key)
		{
			case 'mesh':
				$style = 'style="background-image:url('. \dash\url::cdn(). '/img/sitebuilder/headline/headline1/mesh.png);background-repeat:repeat;"';
				break;

			case 'dark':
				$style = 'style="background-image:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3))"';
				break;


			default:
				break;
		}

		if($style)
		{
			return '<div class="w-full h-full absolute" '. $style. '></div>';
		}

		return null;
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('background_effect');

		if(!$default)
		{
			$default = static::default();
		}


		$title = T_('Background Effect');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_background_effect';

			$radio_html = '';

			foreach (static::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false), true);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>