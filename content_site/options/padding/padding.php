<?php
namespace content_site\options\padding;


trait padding
{
	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto',  'title' => T_("Auto"),    'class' => '', ];
		$enum[] = ['key' => 'xs',    'title' => T_("S"),	   'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'sm',    'title' => T_("M"), 	   'class' => 'min-h-1/4 py-5', ];
		$enum[] = ['key' => 'manual','title' => '...',   	   'class' => '', 	'icon' => \dash\utility\icon::svg('three-dots', 'bootstrap'),];


		$enum[] = ['key' => 'l',  'class' => 'p-0', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => 'xl',  'class' => 'p-px', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '2xl',  'class' => 'p-0.5', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '3xl',  'class' => 'p-1', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '4xl',  'class' => 'p-1.5', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '5xl',  'class' => 'p-2', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '6xl',  'class' => 'p-2.5', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '7xl',  'class' => 'p-3', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '8xl',  'class' => 'p-3.5', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '9xl',  'class' => 'p-4', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '10xl',  'class' => 'p-5', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '11xl',  'class' => 'p-6', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '12xl',  'class' => 'p-7', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '13xl',  'class' => 'p-8', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '14xl',  'class' => 'p-9', 	'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '15xl',  'class' => 'p-10', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '16xl',  'class' => 'p-11', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '17xl',  'class' => 'p-12', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '18xl',  'class' => 'p-14', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '19xl',  'class' => 'p-16', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '20xl',  'class' => 'p-20', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '21xl',  'class' => 'p-24', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '22xl',  'class' => 'p-28', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '23xl',  'class' => 'p-32', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '24xl',  'class' => 'p-36', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '25xl',  'class' => 'p-40', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '26xl',  'class' => 'p-44', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '27xl',  'class' => 'p-48', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '28xl',  'class' => 'p-52', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '29xl',  'class' => 'p-56', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '30xl',  'class' => 'p-60', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '31xl',  'class' => 'p-64', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '32xl',  'class' => 'p-72', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '33xl',  'class' => 'p-80', 'hide' => true, 'is_range' => true];
		$enum[] = ['key' => '34xl',  'class' => 'p-96', 'hide' => true, 'is_range' => true];


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