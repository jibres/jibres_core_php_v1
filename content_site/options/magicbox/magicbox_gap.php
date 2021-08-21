<?php
namespace content_site\options\magicbox;


class magicbox_gap
{


	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_("None"), 'class' => '1'];
		$enum[] = ['key' => 'sm',   'title' => 'S',        'class' => '2'];
		$enum[] = ['key' => 'md',   'title' => 'M',        'class' => '3'];
		$enum[] = ['key' => 'lg',   'title' => 'L',        'class' => '4'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Gap')]);
		return $data;
	}



	public static function default()
	{
		return 'md';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
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


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('magicbox_gap');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_('Gap');

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_magicbox_gap';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false), true);
			}

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';

		return $html;
	}

}
?>