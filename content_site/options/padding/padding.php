<?php
namespace content_site\options\padding;


trait padding
{
	public static function enum()
	{
	$enum   = [];
		$enum[] = ['key' => '1', 'class' => 'py-1 md:py-1.5 lg:py-2', ];
		$enum[] = ['key' => '2', 'class' => 'py-2 md:py-3 lg:py-4', ];
		$enum[] = ['key' => '3', 'class' => 'py-3 md:py-4 lg:py-6', ];
		$enum[] = ['key' => 'manual','title' => '...',   	   'class' => '', 	'icon' => \dash\utility\icon::svg('three-dots', 'bootstrap'),];

		$enum[] = ['key' => '0', 'hide' => true, 'is_range' => true, 'class' => 'p-px'];
		$enum[] = ['key' => '4', 'hide' => true, 'is_range' => true, 'class' => 'py-4 md:py-6 lg:py-8'];
		$enum[] = ['key' => '6', 'hide' => true, 'is_range' => true, 'class' => 'py-6 md:py-8 lg:py-12'];
		$enum[] = ['key' => '8', 'hide' => true, 'is_range' => true, 'class' => 'py-8 md:py-10 lg:py-16'];
		// $enum[] = ['key' => '10', 'hide' => true, 'is_range' => true, 'class' => 'py-10 md:py-6 lg:py-20'];
		$enum[] = ['key' => '12', 'hide' => true, 'is_range' => true, 'class' => 'py-12 md:py-6 lg:py-24'];
		// $enum[] = ['key' => '14', 'hide' => true, 'is_range' => true, 'class' => 'py-14 md:py-6 lg:py-28'];
		$enum[] = ['key' => '16', 'hide' => true, 'is_range' => true, 'class' => 'py-16 md:py-6 lg:py-32'];
		// $enum[] = ['key' => '20', 'hide' => true, 'is_range' => true, 'class' => 'py-20 md:py-6 lg:py-40'];
		$enum[] = ['key' => '24', 'hide' => true, 'is_range' => true, 'class' => 'py-24 md:py-6 lg:py-48'];
		// $enum[] = ['key' => '28', 'hide' => true, 'is_range' => true, 'class' => 'py-28 md:py-6 lg:py-56'];
		$enum[] = ['key' => '32', 'hide' => true, 'is_range' => true, 'class' => 'py-32 md:py-6 lg:py-64'];
		// $enum[] = ['key' => '36', 'hide' => true, 'is_range' => true, 'class' => 'py-36 md:py-6 lg:py-72'];
		// $enum[] = ['key' => '40', 'hide' => true, 'is_range' => true, 'class' => 'py-40 md:py-6 lg:py-80'];
		$enum[] = ['key' => '48', 'hide' => true, 'is_range' => true, 'class' => 'py-48 md:py-6 lg:py-96'];

		return $enum;
	}



	public static function this_range()
	{
		$range = [];
		foreach (self::enum() as $key => $value)
		{
			if(a($value, 'is_range'))
			{
				$range[] = $value['key'];
			}
		}


		return $range;
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


	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => self::title()]);
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


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$title = self::title();

		$html = '';
		$html .= '<div class="accordion" id="'.self::name().'Option">';
		{
			$html .= \content_site\options\generate::form();
			{

					$html .= "<label>$title</label>";

					$name       = 'opt_'. self::name();

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

						$my_name = a($value, 'title');
						if(a($value, 'icon'))
						{
							$my_name = $value['icon'];
						}

						$option = [];

						if($value['key'] === 'manual')
						{
							$option =
							[
								'input'        => false,
								'class'        => 'accordion-collapse ',
								'attr'         => ' data-bs-toggle="collapse" data-bs-target="#optionShowMore'.self::name().'" aria-expanded="true" aria-controls="optionShowMore'.self::name().'"',
							];
						}

						$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $my_name, $selected, null, $option);
					}

					$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);



			}
			$html .= \content_site\options\generate::_form();

			$html .= \content_site\options\generate::form();
			{

					$visible_class = 'show';

					if($default === 'manual' || $default === 'auto' || $default === 'fullscreen')
					{
						$visible_class = null;
					}

					$html .= "<div  id='optionShowMore".self::name()."' class='collapse $visible_class' aria-labelledby='optionMore' data-bs-parent='#".self::name()."Option'>";
					{
						$html .= \content_site\options\generate::rangeslider($name, self::this_range(), $default, null);
					}
					$html .= '</div>';
			}
			$html .= \content_site\options\generate::_form();
		}
		$html .= '</div>';


		return $html;

	}
}
?>