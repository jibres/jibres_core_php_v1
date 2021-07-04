<?php
namespace content_site\options\background;


class background_gradient_from
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'from-transparent'];
		$enum[] = ['key' => 'from-current'];
		$enum[] = ['key' => 'from-black'];
		$enum[] = ['key' => 'from-white'];
		$enum[] = ['key' => 'from-gray-50'];
		$enum[] = ['key' => 'from-gray-100'];
		$enum[] = ['key' => 'from-gray-200'];
		$enum[] = ['key' => 'from-gray-300'];
		$enum[] = ['key' => 'from-gray-400'];
		$enum[] = ['key' => 'from-gray-500'];
		$enum[] = ['key' => 'from-gray-600'];
		$enum[] = ['key' => 'from-gray-700'];
		$enum[] = ['key' => 'from-gray-800'];
		$enum[] = ['key' => 'from-gray-900'];
		$enum[] = ['key' => 'from-red-50'];
		$enum[] = ['key' => 'from-red-100'];
		$enum[] = ['key' => 'from-red-200'];
		$enum[] = ['key' => 'from-red-300'];
		$enum[] = ['key' => 'from-red-400'];
		$enum[] = ['key' => 'from-red-500'];
		$enum[] = ['key' => 'from-red-600'];
		$enum[] = ['key' => 'from-red-700'];
		$enum[] = ['key' => 'from-red-800'];
		$enum[] = ['key' => 'from-red-900'];
		$enum[] = ['key' => 'from-yellow-50'];
		$enum[] = ['key' => 'from-yellow-100'];
		$enum[] = ['key' => 'from-yellow-200'];
		$enum[] = ['key' => 'from-yellow-300'];
		$enum[] = ['key' => 'from-yellow-400'];
		$enum[] = ['key' => 'from-yellow-500'];
		$enum[] = ['key' => 'from-yellow-600'];
		$enum[] = ['key' => 'from-yellow-700'];
		$enum[] = ['key' => 'from-yellow-800'];
		$enum[] = ['key' => 'from-yellow-900'];
		$enum[] = ['key' => 'from-green-50'];
		$enum[] = ['key' => 'from-green-100'];
		$enum[] = ['key' => 'from-green-200'];
		$enum[] = ['key' => 'from-green-300'];
		$enum[] = ['key' => 'from-green-400'];
		$enum[] = ['key' => 'from-green-500'];
		$enum[] = ['key' => 'from-green-600'];
		$enum[] = ['key' => 'from-green-700'];
		$enum[] = ['key' => 'from-green-800'];
		$enum[] = ['key' => 'from-green-900'];
		$enum[] = ['key' => 'from-blue-50'];
		$enum[] = ['key' => 'from-blue-100'];
		$enum[] = ['key' => 'from-blue-200'];
		$enum[] = ['key' => 'from-blue-300'];
		$enum[] = ['key' => 'from-blue-400'];
		$enum[] = ['key' => 'from-blue-500'];
		$enum[] = ['key' => 'from-blue-600'];
		$enum[] = ['key' => 'from-blue-700'];
		$enum[] = ['key' => 'from-blue-800'];
		$enum[] = ['key' => 'from-blue-900'];
		$enum[] = ['key' => 'from-indigo-50'];
		$enum[] = ['key' => 'from-indigo-100'];
		$enum[] = ['key' => 'from-indigo-200'];
		$enum[] = ['key' => 'from-indigo-300'];
		$enum[] = ['key' => 'from-indigo-400'];
		$enum[] = ['key' => 'from-indigo-500'];
		$enum[] = ['key' => 'from-indigo-600'];
		$enum[] = ['key' => 'from-indigo-700'];
		$enum[] = ['key' => 'from-indigo-800'];
		$enum[] = ['key' => 'from-indigo-900'];
		$enum[] = ['key' => 'from-purple-50'];
		$enum[] = ['key' => 'from-purple-100'];
		$enum[] = ['key' => 'from-purple-200'];
		$enum[] = ['key' => 'from-purple-300'];
		$enum[] = ['key' => 'from-purple-400'];
		$enum[] = ['key' => 'from-purple-500'];
		$enum[] = ['key' => 'from-purple-600'];
		$enum[] = ['key' => 'from-purple-700'];
		$enum[] = ['key' => 'from-purple-800'];
		$enum[] = ['key' => 'from-purple-900'];
		$enum[] = ['key' => 'from-pink-50'];
		$enum[] = ['key' => 'from-pink-100'];
		$enum[] = ['key' => 'from-pink-200'];
		$enum[] = ['key' => 'from-pink-300'];
		$enum[] = ['key' => 'from-pink-400'];
		$enum[] = ['key' => 'from-pink-500'];
		$enum[] = ['key' => 'from-pink-600'];
		$enum[] = ['key' => 'from-pink-700'];
		$enum[] = ['key' => 'from-pink-800'];
		$enum[] = ['key' => 'from-pink-900'];

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
		$default = \content_site\section\view::get_current_index_detail('background_gradient_from');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_gradient_from");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="background_gradient_from">';
			$html .= "<label for='background_gradient_from'>$title</label>";
	        $html .= '<select name="background_gradient_from" class="select22"  id="background_gradient_from">';

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