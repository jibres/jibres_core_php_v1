<?php
namespace content_site\options\background;


class background_gradient_via
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'via-transparent'];
		$enum[] = ['key' => 'via-current'];
		$enum[] = ['key' => 'via-black'];
		$enum[] = ['key' => 'via-white'];
		$enum[] = ['key' => 'via-gray-50'];
		$enum[] = ['key' => 'via-gray-100'];
		$enum[] = ['key' => 'via-gray-200'];
		$enum[] = ['key' => 'via-gray-300'];
		$enum[] = ['key' => 'via-gray-400'];
		$enum[] = ['key' => 'via-gray-500'];
		$enum[] = ['key' => 'via-gray-600'];
		$enum[] = ['key' => 'via-gray-700'];
		$enum[] = ['key' => 'via-gray-800'];
		$enum[] = ['key' => 'via-gray-900'];
		$enum[] = ['key' => 'via-red-50'];
		$enum[] = ['key' => 'via-red-100'];
		$enum[] = ['key' => 'via-red-200'];
		$enum[] = ['key' => 'via-red-300'];
		$enum[] = ['key' => 'via-red-400'];
		$enum[] = ['key' => 'via-red-500'];
		$enum[] = ['key' => 'via-red-600'];
		$enum[] = ['key' => 'via-red-700'];
		$enum[] = ['key' => 'via-red-800'];
		$enum[] = ['key' => 'via-red-900'];
		$enum[] = ['key' => 'via-yellow-50'];
		$enum[] = ['key' => 'via-yellow-100'];
		$enum[] = ['key' => 'via-yellow-200'];
		$enum[] = ['key' => 'via-yellow-300'];
		$enum[] = ['key' => 'via-yellow-400'];
		$enum[] = ['key' => 'via-yellow-500'];
		$enum[] = ['key' => 'via-yellow-600'];
		$enum[] = ['key' => 'via-yellow-700'];
		$enum[] = ['key' => 'via-yellow-800'];
		$enum[] = ['key' => 'via-yellow-900'];
		$enum[] = ['key' => 'via-green-50'];
		$enum[] = ['key' => 'via-green-100'];
		$enum[] = ['key' => 'via-green-200'];
		$enum[] = ['key' => 'via-green-300'];
		$enum[] = ['key' => 'via-green-400'];
		$enum[] = ['key' => 'via-green-500'];
		$enum[] = ['key' => 'via-green-600'];
		$enum[] = ['key' => 'via-green-700'];
		$enum[] = ['key' => 'via-green-800'];
		$enum[] = ['key' => 'via-green-900'];
		$enum[] = ['key' => 'via-blue-50'];
		$enum[] = ['key' => 'via-blue-100'];
		$enum[] = ['key' => 'via-blue-200'];
		$enum[] = ['key' => 'via-blue-300'];
		$enum[] = ['key' => 'via-blue-400'];
		$enum[] = ['key' => 'via-blue-500'];
		$enum[] = ['key' => 'via-blue-600'];
		$enum[] = ['key' => 'via-blue-700'];
		$enum[] = ['key' => 'via-blue-800'];
		$enum[] = ['key' => 'via-blue-900'];
		$enum[] = ['key' => 'via-indigo-50'];
		$enum[] = ['key' => 'via-indigo-100'];
		$enum[] = ['key' => 'via-indigo-200'];
		$enum[] = ['key' => 'via-indigo-300'];
		$enum[] = ['key' => 'via-indigo-400'];
		$enum[] = ['key' => 'via-indigo-500'];
		$enum[] = ['key' => 'via-indigo-600'];
		$enum[] = ['key' => 'via-indigo-700'];
		$enum[] = ['key' => 'via-indigo-800'];
		$enum[] = ['key' => 'via-indigo-900'];
		$enum[] = ['key' => 'via-purple-50'];
		$enum[] = ['key' => 'via-purple-100'];
		$enum[] = ['key' => 'via-purple-200'];
		$enum[] = ['key' => 'via-purple-300'];
		$enum[] = ['key' => 'via-purple-400'];
		$enum[] = ['key' => 'via-purple-500'];
		$enum[] = ['key' => 'via-purple-600'];
		$enum[] = ['key' => 'via-purple-700'];
		$enum[] = ['key' => 'via-purple-800'];
		$enum[] = ['key' => 'via-purple-900'];
		$enum[] = ['key' => 'via-pink-50'];
		$enum[] = ['key' => 'via-pink-100'];
		$enum[] = ['key' => 'via-pink-200'];
		$enum[] = ['key' => 'via-pink-300'];
		$enum[] = ['key' => 'via-pink-400'];
		$enum[] = ['key' => 'via-pink-500'];
		$enum[] = ['key' => 'via-pink-600'];
		$enum[] = ['key' => 'via-pink-700'];
		$enum[] = ['key' => 'via-pink-800'];
		$enum[] = ['key' => 'via-pink-900'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Color')]);
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
		$default = \content_site\section\view::get_current_index_detail('background_gradient_via');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_gradient_via");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="background_gradient_via">';
			$html .= "<label for='background_gradient_via'>$title</label>";
	        $html .= '<select name="background_gradient_via" class="select22"  id="background_gradient_via">';

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