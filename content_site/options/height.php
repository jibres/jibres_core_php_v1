<?php
namespace content_site\options;


class height
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 's',   'title' => T_("Short") , 'class' => 'flex min-h-1/4 py-2 lg:py-5', ];
		$enum[] = ['key' => 'm',   'title' => T_("Medium") , 'class' => 'flex min-h-1/2 lg:py-10 lg:py-16', ];
		$enum[] = ['key' => 'l',   'title' => T_("Tall") , 'class' => 'flex min-h-3/4 py-20 lg:py-28', ];
		$enum[] = ['key' => 'fullscreen',   'title' => T_("Full Screen") , 'class' => 'flex min-h-screen py-20', ];
		$enum[] = ['key' => 'fullpreview',   'title' => T_("Full Screen") , 'class' => 'flex min-h-screen py-20', 'system' => true ];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
	}


	public static function default()
	{
		return 'm';
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
		$default = \content_site\section\view::get_current_index_detail('height');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Section Height");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= '<input type="hidden" name="notredirect" value="1">';

			$html .= "<label>$title</label>";

			$name       = 'opt_height';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				if(isset($value['system']) && $value['system'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';


		return $html;

	}
}
?>