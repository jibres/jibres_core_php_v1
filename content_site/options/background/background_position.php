<?php
namespace content_site\options\background;


class background_position
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bottom'];
		$enum[] = ['key' => 'center'];
		$enum[] = ['key' => 'left'];
		$enum[] = ['key' => 'left-bottom'];
		$enum[] = ['key' => 'left-top'];
		$enum[] = ['key' => 'right'];
		$enum[] = ['key' => 'right-bottom'];
		$enum[] = ['key' => 'right-top'];
		$enum[] = ['key' => 'top'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Position')]);
		return $data;
	}


	public static function default()
	{
		return 'center';
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_position');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Background Position");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_position'>$title</label>";
	        $html .= '<select name="opt_background_position" class="select22"  id="background_position">';

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