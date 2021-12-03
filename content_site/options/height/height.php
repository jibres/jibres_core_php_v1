<?php
namespace content_site\options\height;


class height
{
	public static function enum()
	{
		$enum   = [];

		/*====================================
		=            Hidden value            =
		====================================*/
		$enum[] = ['key' => 'sm',          'title' => "S",               'style' => 'min-height: 25vh;',  'hide' => true];
		$enum[] = ['key' => 'md',          'title' => "M",               'style' => 'min-height: 50vh;',  'hide' => true];
		$enum[] = ['key' => 'lg',          'title' => "L",               'style' => 'min-height: 72vh;',  'hide' => true];
		$enum[] = ['key' => 'fullpreview', 'title' => T_("Full Screen"), 'style' => 'min-height: 100vh;', 'hide' => true ];
		/*=====  End of Hidden value  ======*/


		$enum[] = ['key' => 'auto',        'title' => T_("Auto"),        'style' => '',  'hide' => true];
		$enum[] = ['key' => 'fullscreen',  'title' => T_("Full Screen"), 'style' => 'min-height: 100vh;',  'hide' => true];

		for ($i = 5; $i <= 95; $i = $i + 5)
		{
			$enum[] = ['key' => "$i", 'title' => null, 'style' => sprintf('min-height: %svh',$i), 'hide' => true, 'is_range' => true];
		}

		return $enum;
	}


	public static function this_range()
	{
		$range = ['auto'];
		foreach (static::enum() as $key => $value)
		{
			if(a($value, 'is_range'))
			{
				$range[] = $value['key'];
			}
		}

		$range[] = 'fullscreen';

		return $range;
	}


	public static function validator($_data)
	{

		return \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Height')]);
	}


	public static function default()
	{
		return 'auto';
	}



	public static function get_style($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
				{
					return $value['style'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['style'];
				}
			}
		}
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('height');

		if(!$default)
		{
			$default = static::default();
		}

		$name       = 'opt_height';

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider($name, static::this_range(), $default, T_("Section Height"));
		}
		$html .= \content_site\options\generate::_form();

		return $html;

	}
}
?>