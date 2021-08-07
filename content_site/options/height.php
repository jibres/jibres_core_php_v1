<?php
namespace content_site\options;


class height
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto', 'title' => T_("Auto") , 'class' => 'height-auto', 'default' => true];
		// max-height:80vh; height:50vw; padding: 50px 0;
		// $enum[] = ['key' => 'xs',   'title' => T_("Short") , 'class' => 'height-xs', ];
		// max-height:...; height:90px; md:height:125px; padding: 50px 0;
		$enum[] = ['key' => 'sm',   'title' => T_("Fairly Short") , 'class' => 'flex min-h-1/4 py-2 lg:py-5', ];
		// max-height:..; height:225px; md:height:300px; padding: 50px 0;
		$enum[] = ['key' => 'md',   'title' => T_("Medium") , 'class' => 'flex min-h-1/2 lg:py-10 lg:py-16', ];
		// max-height:...; height:350px; md:height:475px; padding: 50px 0;
		$enum[] = ['key' => 'lg',   'title' => T_("Tall") , 'class' => 'flex min-h-3/4 py-20 lg:py-28', ];
		// max-height:...; height:470px; md:height:650px; padding: 50px 0;
		// $enum[] = ['key' => 'xl',   'title' => T_("Full Screen") , 'class' => 'height-xl', ];
		// max-height:... height:580px; md:height:775px; padding: 50px 0;
		// min-height:100vh; min-height:100%; md:height:775px; padding: 50px 0;
		$enum[] = ['key' => 'fullscreen',   'title' => T_("Full Screen") , 'class' => 'flex min-h-screen py-20', ];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => ['xs', 'auto', 'xl', 'fullscreen'], 'field_title' => T_('Height')]);
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
				if(isset($value['default']) && $value['default'])
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
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'xs', 'S', (($default === 'xs')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'auto', 'M', (($default === 'auto')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'xl', 'L', (($default === 'xl')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'fullscreen', T_("FullScreen"), (($default === 'fullscreen')? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';


		return $html;

	}
}
?>