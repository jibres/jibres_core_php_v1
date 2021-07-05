<?php
namespace content_site\options\background;


class background_size
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto'];
		$enum[] = ['key' => 'cover'];
		$enum[] = ['key' => 'contain'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Size')]);
		return $data;
	}


	public static function default()
	{
		return 'auto';
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_size');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Background size");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_size'>$title</label>";
	        $html .= '<select name="opt_background_size" class="select22"  id="background_size">';

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