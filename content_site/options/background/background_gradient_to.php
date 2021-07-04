<?php
namespace content_site\options\background;


class background_gradient_to
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'to-transparent'];
		$enum[] = ['key' => 'to-current'];
		$enum[] = ['key' => 'to-black'];
		$enum[] = ['key' => 'to-white'];
		$enum[] = ['key' => 'to-gray-50'];
		$enum[] = ['key' => 'to-gray-100'];
		$enum[] = ['key' => 'to-gray-200'];
		$enum[] = ['key' => 'to-gray-300'];
		$enum[] = ['key' => 'to-gray-400'];
		$enum[] = ['key' => 'to-gray-500'];
		$enum[] = ['key' => 'to-gray-600'];
		$enum[] = ['key' => 'to-gray-700'];
		$enum[] = ['key' => 'to-gray-800'];
		$enum[] = ['key' => 'to-gray-900'];
		$enum[] = ['key' => 'to-red-50'];
		$enum[] = ['key' => 'to-red-100'];
		$enum[] = ['key' => 'to-red-200'];
		$enum[] = ['key' => 'to-red-300'];
		$enum[] = ['key' => 'to-red-400'];
		$enum[] = ['key' => 'to-red-500'];
		$enum[] = ['key' => 'to-red-600'];
		$enum[] = ['key' => 'to-red-700'];
		$enum[] = ['key' => 'to-red-800'];
		$enum[] = ['key' => 'to-red-900'];
		$enum[] = ['key' => 'to-yellow-50'];
		$enum[] = ['key' => 'to-yellow-100'];
		$enum[] = ['key' => 'to-yellow-200'];
		$enum[] = ['key' => 'to-yellow-300'];
		$enum[] = ['key' => 'to-yellow-400'];
		$enum[] = ['key' => 'to-yellow-500'];
		$enum[] = ['key' => 'to-yellow-600'];
		$enum[] = ['key' => 'to-yellow-700'];
		$enum[] = ['key' => 'to-yellow-800'];
		$enum[] = ['key' => 'to-yellow-900'];
		$enum[] = ['key' => 'to-green-50'];
		$enum[] = ['key' => 'to-green-100'];
		$enum[] = ['key' => 'to-green-200'];
		$enum[] = ['key' => 'to-green-300'];
		$enum[] = ['key' => 'to-green-400'];
		$enum[] = ['key' => 'to-green-500'];
		$enum[] = ['key' => 'to-green-600'];
		$enum[] = ['key' => 'to-green-700'];
		$enum[] = ['key' => 'to-green-800'];
		$enum[] = ['key' => 'to-green-900'];
		$enum[] = ['key' => 'to-blue-50'];
		$enum[] = ['key' => 'to-blue-100'];
		$enum[] = ['key' => 'to-blue-200'];
		$enum[] = ['key' => 'to-blue-300'];
		$enum[] = ['key' => 'to-blue-400'];
		$enum[] = ['key' => 'to-blue-500'];
		$enum[] = ['key' => 'to-blue-600'];
		$enum[] = ['key' => 'to-blue-700'];
		$enum[] = ['key' => 'to-blue-800'];
		$enum[] = ['key' => 'to-blue-900'];
		$enum[] = ['key' => 'to-indigo-50'];
		$enum[] = ['key' => 'to-indigo-100'];
		$enum[] = ['key' => 'to-indigo-200'];
		$enum[] = ['key' => 'to-indigo-300'];
		$enum[] = ['key' => 'to-indigo-400'];
		$enum[] = ['key' => 'to-indigo-500'];
		$enum[] = ['key' => 'to-indigo-600'];
		$enum[] = ['key' => 'to-indigo-700'];
		$enum[] = ['key' => 'to-indigo-800'];
		$enum[] = ['key' => 'to-indigo-900'];
		$enum[] = ['key' => 'to-purple-50'];
		$enum[] = ['key' => 'to-purple-100'];
		$enum[] = ['key' => 'to-purple-200'];
		$enum[] = ['key' => 'to-purple-300'];
		$enum[] = ['key' => 'to-purple-400'];
		$enum[] = ['key' => 'to-purple-500'];
		$enum[] = ['key' => 'to-purple-600'];
		$enum[] = ['key' => 'to-purple-700'];
		$enum[] = ['key' => 'to-purple-800'];
		$enum[] = ['key' => 'to-purple-900'];
		$enum[] = ['key' => 'to-pink-50'];
		$enum[] = ['key' => 'to-pink-100'];
		$enum[] = ['key' => 'to-pink-200'];
		$enum[] = ['key' => 'to-pink-300'];
		$enum[] = ['key' => 'to-pink-400'];
		$enum[] = ['key' => 'to-pink-500'];
		$enum[] = ['key' => 'to-pink-600'];
		$enum[] = ['key' => 'to-pink-700'];
		$enum[] = ['key' => 'to-pink-800'];
		$enum[] = ['key' => 'to-pink-900'];

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
		$default = \content_site\section\view::get_current_index_detail('background_gradient_to');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_gradient_to");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_gradient_to'>$title</label>";
	        $html .= '<select name="opt_background_gradient_to" class="select22"  id="background_gradient_to">';

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