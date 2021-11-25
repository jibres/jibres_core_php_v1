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
		$enum[] = ['key' => 'sm',          'title' => "S",               'style' => 'min-height: 25vh;', 'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', 'hide' => true];
		$enum[] = ['key' => 'md',          'title' => "M",               'style' => 'min-height: 50vh;', 'class_wo_padding' => 'min-h-1/2',    'class' => 'min-h-1/2 py-5 md:py-10 lg:py-16', 'hide' => true];
		$enum[] = ['key' => 'lg',          'title' => "L",               'style' => 'min-height: 72vh;', 'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', 'hide' => true];
		$enum[] = ['key' => 'fullpreview', 'title' => T_("Full Screen"), 'style' => 'min-height: 100vh;', 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5', 'hide' => true ];
		/*=====  End of Hidden value  ======*/


		$enum[] = ['key' => 'auto',        'title' => T_("Auto"),        'style' => '', 'class_wo_padding' => '',             'class' => '',  'hide' => true];
		$enum[] = ['key' => 'fullscreen',  'title' => T_("Full Screen"), 'style' => 'min-height: 100vh;', 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5 md:py-10 lg:py-20',  'hide' => true];
		// $enum[] = ['key' => 'manual',      'title' => '...',        	 'style' => 'min-height: 10vh;', 'class_wo_padding' => '',             'class' => '', 'icon' => \dash\utility\icon::svg('three-dots', 'bootstrap'), 'hide' => true];

		for ($i = 5; $i <= 95; $i = $i + 5)
		{
			$enum[] = ['key' => "$i", 'title' => null, 'style' => sprintf('min-height: %svh',$i), 'hide' => true, 'is_range' => true];
		}

		return $enum;
	}


	public static function this_range()
	{
		$range = ['auto'];
		foreach (self::enum() as $key => $value)
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

		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
	}


	public static function default()
	{
		return 'auto';
	}



	public static function get_style($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
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
			$default = self::default();
		}

		$name       = 'opt_height';

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider($name, self::this_range(), $default, T_("Section Height"));
		}
		$html .= \content_site\options\generate::_form();

		return $html;

	}
}
?>