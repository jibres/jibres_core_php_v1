<?php
namespace content_site\options\background;


class background_gradient_type
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'to top', 'title' => T_("To top")];
		$enum[] = ['key' => 'to top right', 'title' => T_("To top right")];
		$enum[] = ['key' => 'to right', 'title' => T_("To right")];
		$enum[] = ['key' => 'to bottom right', 'title' => T_("To bottom right")];
		$enum[] = ['key' => 'to bottom', 'title' => T_("To bottom")];
		$enum[] = ['key' => 'to bottom left', 'title' => T_("To bottom left")];
		$enum[] = ['key' => 'to left', 'title' => T_("To left")];
		$enum[] = ['key' => 'to top left', 'title' => T_("To top left")];
		// $enum[] = ['key' => 'redial', 'title' => T_("Redial")];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Gradient Type')]);
		return $data;
	}


	public static function default()
	{
		return 'to top';
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_gradient_type');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Gradient direction");

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
	        	$html .= $value['title'];
	        	$html .= "</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>