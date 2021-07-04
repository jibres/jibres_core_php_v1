<?php
namespace content_site\options\background;


class background_color
{

	private static function enum()
	{
		$enum   = \content_site\color\color::list();
		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'color'), 'field_title' => T_('Color')]);
		return $data;
	}


	public static function default()
	{
		return 'white';
	}


	public static function class_name($_key)
	{

		if(!$_key)
		{
			return self::default();
		}

		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if($value['color'] === $_key)
			{
				return $value['color'];
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

		$title = T_("Background Color");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_color'>$title</label>";
		    $html .= '<div class="text-center">';
		    {
		    	foreach (\content_site\color\color::color_name() as $color)
		    	{
		    		$html .= '<div class="grid grid-cols-10">';
			    	foreach (\content_site\color\color::color_opacity() as $opaicty)
			    	{
					    $html .= '<div class="h-12 bg-'. $color. '-'. $opaicty. '"></div>';
			    	}
		    		$html .= '</div>';
		    	}
		    	$html .= '<div class="grid grid-cols-2">';
		    	{
			    	$html .= '<div class="h-12 bg-white">'. T_("White"). '</div>';
			    	$html .= '<div class="h-12 bg-black">'. T_("Black"). '</div>';
		    	}
		    	$html .= '</div>';
		    }
		    $html .= '</div>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>