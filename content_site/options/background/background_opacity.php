<?php
namespace content_site\options\background;


class background_opacity
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bg-opacity-0'];
		$enum[] = ['key' => 'bg-opacity-5'];
		$enum[] = ['key' => 'bg-opacity-10'];
		$enum[] = ['key' => 'bg-opacity-20'];
		$enum[] = ['key' => 'bg-opacity-25'];
		$enum[] = ['key' => 'bg-opacity-30'];
		$enum[] = ['key' => 'bg-opacity-40'];
		$enum[] = ['key' => 'bg-opacity-50'];
		$enum[] = ['key' => 'bg-opacity-60'];
		$enum[] = ['key' => 'bg-opacity-70'];
		$enum[] = ['key' => 'bg-opacity-75'];
		$enum[] = ['key' => 'bg-opacity-80'];
		$enum[] = ['key' => 'bg-opacity-90'];
		$enum[] = ['key' => 'bg-opacity-95'];
		$enum[] = ['key' => 'bg-opacity-100', 'default' => true];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Opacity')]);
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
		$default = \content_site\section\view::get_current_index_detail('background_opacity');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_opacity");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="background_opacity">';
			$html .= "<label for='background_opacity'>$title</label>";
	        $html .= '<select name="background_opacity" class="select22"  id="background_opacity">';

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