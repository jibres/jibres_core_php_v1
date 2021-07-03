<?php
namespace content_site\options\background;


class background_color
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bg-black', 'default' => true ];
		$enum[] = ['key' => 'bg-white', ];
		$enum[] = ['key' => 'bg-gray-50',];
		$enum[] = ['key' => 'bg-gray-100',];
		$enum[] = ['key' => 'bg-gray-200',];
		$enum[] = ['key' => 'bg-gray-300',];
		$enum[] = ['key' => 'bg-gray-400',];
		$enum[] = ['key' => 'bg-gray-500',];
		$enum[] = ['key' => 'bg-gray-600',];
		$enum[] = ['key' => 'bg-gray-700',];
		$enum[] = ['key' => 'bg-gray-800',];
		$enum[] = ['key' => 'bg-gray-900',];
		$enum[] = ['key' => 'bg-red-50',];
		$enum[] = ['key' => 'bg-red-100',];
		$enum[] = ['key' => 'bg-red-200',];
		$enum[] = ['key' => 'bg-red-300',];
		$enum[] = ['key' => 'bg-red-400',];
		$enum[] = ['key' => 'bg-red-500',];
		$enum[] = ['key' => 'bg-red-600',];
		$enum[] = ['key' => 'bg-red-700',];
		$enum[] = ['key' => 'bg-red-800',];
		$enum[] = ['key' => 'bg-red-900',];
		$enum[] = ['key' => 'bg-yellow-50',];
		$enum[] = ['key' => 'bg-yellow-100',];
		$enum[] = ['key' => 'bg-yellow-200',];
		$enum[] = ['key' => 'bg-yellow-300',];
		$enum[] = ['key' => 'bg-yellow-400',];
		$enum[] = ['key' => 'bg-yellow-500',];
		$enum[] = ['key' => 'bg-yellow-600',];
		$enum[] = ['key' => 'bg-yellow-700',];
		$enum[] = ['key' => 'bg-yellow-800',];
		$enum[] = ['key' => 'bg-yellow-900',];
		$enum[] = ['key' => 'bg-green-50',];
		$enum[] = ['key' => 'bg-green-100',];
		$enum[] = ['key' => 'bg-green-200',];
		$enum[] = ['key' => 'bg-green-300',];
		$enum[] = ['key' => 'bg-green-400',];
		$enum[] = ['key' => 'bg-green-500',];
		$enum[] = ['key' => 'bg-green-600',];
		$enum[] = ['key' => 'bg-green-700',];
		$enum[] = ['key' => 'bg-green-800',];
		$enum[] = ['key' => 'bg-green-900',];
		$enum[] = ['key' => 'bg-blue-50',];
		$enum[] = ['key' => 'bg-blue-100',];
		$enum[] = ['key' => 'bg-blue-200',];
		$enum[] = ['key' => 'bg-blue-300',];
		$enum[] = ['key' => 'bg-blue-400',];
		$enum[] = ['key' => 'bg-blue-500',];
		$enum[] = ['key' => 'bg-blue-600',];
		$enum[] = ['key' => 'bg-blue-700',];
		$enum[] = ['key' => 'bg-blue-800',];
		$enum[] = ['key' => 'bg-blue-900',];
		$enum[] = ['key' => 'bg-indigo-50',];
		$enum[] = ['key' => 'bg-indigo-100',];
		$enum[] = ['key' => 'bg-indigo-200',];
		$enum[] = ['key' => 'bg-indigo-300',];
		$enum[] = ['key' => 'bg-indigo-400',];
		$enum[] = ['key' => 'bg-indigo-500',];
		$enum[] = ['key' => 'bg-indigo-600',];
		$enum[] = ['key' => 'bg-indigo-700',];
		$enum[] = ['key' => 'bg-indigo-800',];
		$enum[] = ['key' => 'bg-indigo-900',];
		$enum[] = ['key' => 'bg-purple-50',];
		$enum[] = ['key' => 'bg-purple-100',];
		$enum[] = ['key' => 'bg-purple-200',];
		$enum[] = ['key' => 'bg-purple-300',];
		$enum[] = ['key' => 'bg-purple-400',];
		$enum[] = ['key' => 'bg-purple-500',];
		$enum[] = ['key' => 'bg-purple-600',];
		$enum[] = ['key' => 'bg-purple-700',];
		$enum[] = ['key' => 'bg-purple-800',];
		$enum[] = ['key' => 'bg-purple-900',];
		$enum[] = ['key' => 'bg-pink-50',];
		$enum[] = ['key' => 'bg-pink-100',];
		$enum[] = ['key' => 'bg-pink-200',];
		$enum[] = ['key' => 'bg-pink-300',];
		$enum[] = ['key' => 'bg-pink-400',];
		$enum[] = ['key' => 'bg-pink-500',];
		$enum[] = ['key' => 'bg-pink-600',];
		$enum[] = ['key' => 'bg-pink-700',];
		$enum[] = ['key' => 'bg-pink-800',];
		$enum[] = ['key' => 'bg-pink-900',];



		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Color')]);
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
		$default = \content_site\section\view::get_current_index_detail('background_color');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Set item background_color");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="background_color">';
			$html .= "<label for='background_color'>$title</label>";
	        $html .= '<select name="background_color" class="select22"  id="background_color">';

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