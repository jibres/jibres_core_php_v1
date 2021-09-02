<?php
namespace content_site\options\height;


class height
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto',        'title' => T_("Auto"),        'class_wo_padding' => '',             'class' => '', ];
		$enum[] = ['key' => 'sm',          'title' => "S",               'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'md',          'title' => "M",               'class_wo_padding' => 'min-h-1/2',    'class' => 'min-h-1/2 py-5 md:py-10 lg:py-16', ];
		$enum[] = ['key' => 'lg',          'title' => "L",               'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', ];
		$enum[] = ['key' => 'fullscreen',  'title' => T_("Full Screen"), 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5 md:py-10 lg:py-20', ];
		$enum[] = ['key' => 'fullpreview', 'title' => T_("Full Screen"), 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5', 'hide' => true ];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
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


	public static function class_name_wo_padding($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
				{
					return $value['class_wo_padding'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class_wo_padding'];
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
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_height';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				if(isset($value['hide']) && $value['hide'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>