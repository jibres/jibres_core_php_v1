<?php
namespace content_site\options;


class style
{
	private static function enum()
	{
		$enum = [];

		$enum = \content_site\call_function::style_list(\dash\data::currentSectionDetail_mode(), a(\dash\data::currentSectionDetail(), 'preview', 'key'));

		if(!is_array($enum))
		{
			$enum = [];
		}

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Style')]);
		return $data;
	}


	public static function default()
	{
		$default = self::enum();

		foreach ($default as $key => $value)
		{
			if(isset($value['default']) && $value['default'])
			{
				return $value['key'];
			}
		}

		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('style');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Set item style");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="style">';
			$html .= "<label for='style'>$title</label>";
	        $html .= '<select name="style" class="select22" id="style">';

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