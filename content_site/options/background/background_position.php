<?php
namespace content_site\options\background;


class background_position
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bg-bottom'];
		$enum[] = ['key' => 'bg-center'];
		$enum[] = ['key' => 'bg-left'];
		$enum[] = ['key' => 'bg-left-bottom'];
		$enum[] = ['key' => 'bg-left-top'];
		$enum[] = ['key' => 'bg-right'];
		$enum[] = ['key' => 'bg-right-bottom'];
		$enum[] = ['key' => 'bg-right-top'];
		$enum[] = ['key' => 'bg-top', 'default' => true];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Position')]);
		return $data;
	}


	public static function default()
	{
		return 'bg-black';
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
		$default = \content_site\section\view::get_current_index_detail('background_position');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_position");

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