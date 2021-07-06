<?php
namespace content_site\options\background;


class background_gradient_type
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'none'];
		$enum[] = ['key' => 'gradient-to-t'];
		$enum[] = ['key' => 'gradient-to-tr'];
		$enum[] = ['key' => 'gradient-to-r'];
		$enum[] = ['key' => 'gradient-to-br'];
		$enum[] = ['key' => 'gradient-to-b'];
		$enum[] = ['key' => 'gradient-to-bl'];
		$enum[] = ['key' => 'gradient-to-l'];
		$enum[] = ['key' => 'gradient-to-tl'];
		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Gradient Type')]);
		return $data;
	}


	public static function default()
	{
		return 'gradient-to-b';
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_gradient_type');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Background Gradient Type");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_gradient_type'>$title</label>";
	        $html .= '<select name="opt_background_gradient_type" class="select22"  id="background_gradient_type">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>";
	        	$html .= $value['key'];
	        	$html .= "</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>