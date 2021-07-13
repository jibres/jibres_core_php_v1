<?php
namespace content_site\options;


class font
{
	private static function enum()
	{

		$enum   = [];
		$enum[] = ['key' => 'IRANSansX', 		'title' =>  'IRANSansX',];
		$enum[] = ['key' => 'IRANYekan', 		'title' =>  'IRANYekan',];
		$enum[] = ['key' => 'LatoLatinWeb', 	'title' =>  'LatoLatinWeb',];
		$enum[] = ['key' => 'Vazir', 			'title' =>  'Vazir',];
		$enum[] = ['key' => 'tahoma', 			'title' =>  'tahoma',];
		$enum[] = ['key' => 'GanjNamehSans', 	'title' =>  'GanjNamehSans',];
		$enum[] = ['key' => 'NikaWeb', 			'title' =>  'NikaWeb',];
		$enum[] = ['key' => 'BehdadWeb', 		'title' =>  'BehdadWeb',];
		$enum[] = ['key' => 'WebNastaliq', 		'title' =>  'WebNastaliq',];
		$enum[] = ['key' => 'Lalezar', 			'title' =>  'Lalezar',];

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Font')]);
		return $data;
	}


	public static function default()
	{
		return 'none';
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