<?php
namespace content_site\options;


class font
{
	private static function enum()
	{

		$enum   = [];

		if(\dash\language::current() === 'fa')
		{
			$enum[] = ['key' => '', 				'title' =>  T_("Default") . ' ('. T_('IRANYekan'). ')',];
		}
		else
		{
			$enum[] = ['key' => '', 				'title' =>  T_("Default") . ' ('. T_('Lato'). ')',];
		}

		if(\dash\language::current() === 'fa')
		{
			$enum[] = ['key' => 'IRANYekan',     'title' =>  T_('IRANYekan'),];
			$enum[] = ['key' => 'Vazir',         'title' =>  T_('Vazir'),];
			$enum[] = ['key' => 'BehdadWeb',     'title' =>  T_('Behdad'),];
			$enum[] = ['key' => 'NikaWeb',       'title' =>  T_('Nika'),];
			$enum[] = ['key' => 'GanjNamehSans', 'title' =>  T_('GanjNameh'),];
			$enum[] = ['key' => 'Lalezar',       'title' =>  T_('Lalezar'),];
			$enum[] = ['key' => 'WebNastaliq',   'title' =>  T_('Nastaliq'),];
			$enum[] = ['key' => 'tahoma',        'title' =>  T_('Tahoma'),];
		}

		$enum[] = ['key' => 'LatoLatinWeb',    'title' =>  'Lato',];

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


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('font');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Font");

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