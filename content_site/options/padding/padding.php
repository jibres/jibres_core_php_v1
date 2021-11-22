<?php
namespace content_site\options\padding;


trait padding
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'zero',   'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'auto',   'class_wo_padding' => '',             'class' => '', ];
		$enum[] = ['key' => 'xs',     'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'sm',     'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'md',     'class_wo_padding' => 'min-h-1/2',    'class' => 'min-h-1/2 py-5 md:py-10 lg:py-16', ];
		$enum[] = ['key' => 'lg',     'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', ];
		$enum[] = ['key' => 'xl',     'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', ];
		$enum[] = ['key' => 'xxl',    'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', ];
		$enum[] = ['key' => 'xxxl',   'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', ];

		return $enum;
	}

	public static function this_range()
	{
		return array_column(self::enum(), 'key');
	}


	public static function name()
	{
		return 'padding';
	}

	public static function title()
	{
		return T_("Padding");
	}


	public static function db_key()
	{
		return 'padding';
	}

	public static function extends_option()
	{
		return
		[
			'height',
			'padding_top',
			'padding_bottom',
		];
	}


	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => self::title()]);
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
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider('opt_'. self::name(), self::this_range(), $default, self::title());
		}
  		$html .= \content_site\options\generate::_form();



		return $html;

	}
}
?>