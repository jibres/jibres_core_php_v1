<?php
namespace content_site\options\padding;


trait padding
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => '0', 'class' => 'p-px'];
		$enum[] = ['key' => '1', 'class' => 'py-1 md:py-1.5 lg:py-2', ];
		$enum[] = ['key' => '2', 'class' => 'py-2 md:py-3 lg:py-4', ];
		$enum[] = ['key' => '3', 'class' => 'py-3 md:py-4 lg:py-6', ];
		$enum[] = ['key' => '4', 'class' => 'py-4 md:py-6 lg:py-8'];
		$enum[] = ['key' => '6', 'class' => 'py-6 md:py-8 lg:py-12'];
		$enum[] = ['key' => '8', 'class' => 'py-8 md:py-10 lg:py-16'];
		// $enum[] = ['key' => '10', 'class' => 'py-10 md:py-6 lg:py-20'];
		$enum[] = ['key' => '12', 'class' => 'py-12 md:py-6 lg:py-24'];
		// $enum[] = ['key' => '14', 'class' => 'py-14 md:py-6 lg:py-28'];
		$enum[] = ['key' => '16', 'class' => 'py-16 md:py-6 lg:py-32'];
		// $enum[] = ['key' => '20', 'class' => 'py-20 md:py-6 lg:py-40'];
		$enum[] = ['key' => '24', 'class' => 'py-24 md:py-6 lg:py-48'];
		// $enum[] = ['key' => '28', 'class' => 'py-28 md:py-6 lg:py-56'];
		$enum[] = ['key' => '32', 'class' => 'py-32 md:py-6 lg:py-64'];
		// $enum[] = ['key' => '36', 'class' => 'py-36 md:py-6 lg:py-72'];
		// $enum[] = ['key' => '40', 'class' => 'py-40 md:py-6 lg:py-80'];
		$enum[] = ['key' => '48', 'class' => 'py-48 md:py-6 lg:py-96'];

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
		return '2';
	}


	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => self::title()]);
	}


	public static function default()
	{
		return 'auto';
	}

	private static function find_padding_class($_key)
	{
		foreach (self::enum() as $key => $value)
		{
			if($value['key'] === $_key)
			{
				return $value['class'];
			}
		}

		return '';
	}

	public static function class_name($_top, $_bottom)
	{

		$class = '';

		if(!$_top && !$_bottom)
		{
			$class .= self::find_padding_class(self::default());
		}
		elseif($_top === $_bottom)
		{
			$class .= self::find_padding_class($_top);
		}
		else
		{
			$class .= str_replace('y', 't', self::find_padding_class($_top));
			$class .= ' '. str_replace('y', 'b', self::find_padding_class($_bottom));
		}

		return $class;



	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$title = self::title();

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