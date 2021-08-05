<?php
namespace content_site\options;


class font
{
	private static function enum()
	{

		$enum   = [];

		$enum[] = ['key' => '', 				'title' =>  T_("Default"),];

		if(\dash\language::current() === 'fa')
		{
			$enum[] = ['key' => 'IRANYekan', 		'title' =>  T_('IRANYekan'),];
			$enum[] = ['key' => 'Vazir', 			'title' =>  T_('Vazir'),];
			$enum[] = ['key' => 'tahoma', 			'title' =>  T_('tahoma'),];
			$enum[] = ['key' => 'GanjNamehSans', 	'title' =>  T_('GanjNamehSans'),];
			$enum[] = ['key' => 'WebNastaliq', 		'title' =>  T_('WebNastaliq'),];
			$enum[] = ['key' => 'NikaWeb', 			'title' =>  T_('NikaWeb'),];
			$enum[] = ['key' => 'BehdadWeb', 		'title' =>  T_('BehdadWeb'),];
			$enum[] = ['key' => 'Lalezar', 			'title' =>  T_('Lalezar'),];
		}

		$enum[] = ['key' => 'LatoLatinWeb', 	'title' =>  T_('LatoLatinWeb'),];

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Font')]);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('font');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item font");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='font'>$title</label>";
	        $html .= '<select name="opt_font" class="select22" id="font">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>