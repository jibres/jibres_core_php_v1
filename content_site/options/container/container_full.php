<?php
namespace content_site\options\container;


class container_full
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'auto', 'title' => T_("Auto"), 	  'class'   => 'avand', 'default' => true ];
		$enum[] = ['key' => 'sm', 	'title' => T_("Small"), 	'class'   => 'avand-sm' ];
		$enum[] = ['key' => 'md', 	'title' => T_("Medium"), 	'class'   => 'avand-md' ];
		$enum[] = ['key' => 'lg', 	'title' => T_("Large"), 	'class'   => 'avand-lg', 'system' => true ];
		$enum[] = ['key' => 'xl', 	'title' => T_("X Large"), 'class'   => 'avand-xl', 'system' => true ];
		$enum[] = ['key' => 'none', 'title' => T_("None"), 		'class'   => '' ];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);


		return $data;

	}


	public static function default()
	{
		return 'auto';
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


	public static function db_key()
	{
		return 'container';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('container');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Content Width");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_container_full';

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

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= '</form>';



		return $html;
	}

}
?>