<?php
namespace content_site\options\background;


class background_color
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_("None"), 		'class' => 'class-none', 'default' => true ];
		$enum[] = ['key' => 'sm', 	'title' => T_("Small"), 	'class' => 'class-sm' ];
		$enum[] = ['key' => 'md', 	'title' => T_("Medium"), 	'class' => 'class-md' ];
		$enum[] = ['key' => 'lg', 	'title' => T_("Large"), 	'class' => 'class-lg' ];
		$enum[] = ['key' => 'xl', 	'title' => T_("X Large"), 	'class' => 'class-xl' ];
		$enum[] = ['key' => 'xxl', 	'title' => T_("XX Large"), 	'class' => 'class-xxl' ];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Container')]);
		return $data;
	}


	public static function default()
	{
		return 'lg';
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
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
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
	        $html .= '<select name="background_color" class="select22" id="background_color">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>