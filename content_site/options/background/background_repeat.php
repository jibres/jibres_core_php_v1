<?php
namespace content_site\options\background;


class background_repeat
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'bg-repeat', 'default' => true];
		$enum[] = ['key' => 'bg-no-repeat'];
		$enum[] = ['key' => 'bg-repeat-x'];
		$enum[] = ['key' => 'bg-repeat-y'];
		$enum[] = ['key' => 'bg-repeat-round'];
		$enum[] = ['key' => 'bg-repeat-space'];
		$enum[] = ['key' => 'bg-right-bottom'];


		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Repeat')]);
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
		$default = \content_site\section\view::get_current_index_detail('background_repeat');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_repeat");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="background_repeat">';
			$html .= "<label for='background_repeat'>$title</label>";
	        $html .= '<select name="background_repeat" class="select22"  id="background_repeat">';

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