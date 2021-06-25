<?php
namespace content_site\options;


class ratio
{
	private static function enum()
	{
		$list = \lib\ratio::list();


		$enum   = [];

		foreach ($list as $key => $value)
		{
			$enum[] = ['key' => $key, 		'title' => a($value, 'title'), 			];
		}

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Ratio')]);
		return $data;
	}


	public static function default()
	{
		return '1:1';
	}


	public static function admin_html($_section_detail)
	{

		$default = \content_site\section\view::get_current_index_detail('ratio');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Set item ratio");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="ratio">';
			$html .= "<label for='ratio'>$title</label>";
	        $html .= '<select name="ratio" class="select22" id="ratio">';

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