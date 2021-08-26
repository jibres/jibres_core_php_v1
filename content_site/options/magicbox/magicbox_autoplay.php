<?php
namespace content_site\options\magicbox;


class magicbox_autoplay
{


	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_("None"), 'class' => ''];
		$enum[] = ['key' => 'slow',   'title' => T_("Slow"),        'class' => 'gap-0.5 sm:gap-1 md:gap-2 lg:gap-4'];
		$enum[] = ['key' => 'fase',   'title' => T_("Fast"),        'class' => 'gap-1 sm:gap-2 md:gap-4 lg:gap-6'];

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

		$default = \content_site\section\view::get_current_index_detail('magicbox_autoplay');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_('Auto play slider');

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_magicbox_autoplay';

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