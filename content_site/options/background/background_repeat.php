<?php
namespace content_site\options\background;


class background_repeat
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'repeat', 'default' => true];
		$enum[] = ['key' => 'no-repeat'];
		$enum[] = ['key' => 'repeat-x'];
		$enum[] = ['key' => 'repeat-y'];
		$enum[] = ['key' => 'repeat-round'];
		$enum[] = ['key' => 'repeat-space'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Repeat')]);
		return $data;
	}


	public static function default()
	{
		return 'repeat';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if(isset($value['default']) && $value['default'])
				{
					return $value['key'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['key'];
				}
			}
		}
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_repeat');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_repeat");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_repeat'>$title</label>";
	        $html .= '<select name="opt_background_repeat" class="select22"  id="background_repeat">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>";
	        	$html .= $value['key'];
	        	// $html .= "<div class='$value[key]'>salam</div>";
	        	$html .= "</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>