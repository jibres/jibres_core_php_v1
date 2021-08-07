<?php
namespace content_site\options\background;


class background_position
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bottom', 			'title' => T_('Bottom'),];
		$enum[] = ['key' => 'center', 			'title' => T_('Center'),];
		$enum[] = ['key' => 'left', 			'title' => T_('Left'),];
		$enum[] = ['key' => 'left bottom', 		'title' => T_('Left Bottom'),];
		$enum[] = ['key' => 'left top', 		'title' => T_('Left Top'),];
		$enum[] = ['key' => 'right', 			'title' => T_('Right'),];
		$enum[] = ['key' => 'right bottom', 	'title' => T_('Right Bottom'),];
		$enum[] = ['key' => 'right top', 		'title' => T_('Right Top'),];
		$enum[] = ['key' => 'top', 				'title' => T_('Top'),];

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


	public static function admin_html()
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