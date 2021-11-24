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
		$enum[] = ['key' => 'sm',          'title' => "S",               'class_wo_padding' => 'min-h-1/4',    'class' => 'min-h-1/4 py-5', 'hide' => true];
		$enum[] = ['key' => 'md',          'title' => "M",               'class_wo_padding' => 'min-h-1/2',    'class' => 'min-h-1/2 py-5 md:py-10 lg:py-16', 'hide' => true];
		$enum[] = ['key' => 'lg',          'title' => "L",               'class_wo_padding' => 'min-h-3/4',    'class' => 'min-h-3/4 py-5 md:py-20 lg:py-28', 'hide' => true];
		$enum[] = ['key' => 'fullpreview', 'title' => T_("Full Screen"), 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5', 'hide' => true ];
		/*=====  End of Hidden value  ======*/


		$enum[] = ['key' => 'auto',        'title' => T_("Auto"),        'class_wo_padding' => '',             'class' => '', ];
		$enum[] = ['key' => 'fullscreen',  'title' => T_("Full Screen"), 'class_wo_padding' => 'min-h-screen', 'class' => 'min-h-screen py-5 md:py-10 lg:py-20', ];
		$enum[] = ['key' => 'manual',      'title' => '...',        	 'class_wo_padding' => '',             'class' => '', 'icon' => \dash\utility\icon::svg('three-dots', 'bootstrap'),];

		for ($i = 10; $i <= 95; $i = $i +5)
		{
			$enum[] = ['key' => $i, 'title' => null, 'class' => '', 'hide' => true, 'is_range' => true];
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
		$html .= '<div class="accordion" id="heightOption">';
		{
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

						$my_name = $value['title'];
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
								'attr'         => ' data-bs-toggle="collapse" data-bs-target="#optionShowMore" aria-expanded="true" aria-controls="optionShowMore"',
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

					$html .= "<div  id='optionShowMore' class='collapse $visible_class' aria-labelledby='optionHeightMore' data-bs-parent='#heightOption'>";
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