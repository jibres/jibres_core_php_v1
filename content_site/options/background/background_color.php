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
		$html .= '<nav class="items mT20">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
		      		$html .= "<div class='item f' data-kerkere='.showColorPreview'>";
		      		{
		        		$html .= "<div class='h-12 w-20 bg-". $default. "'></div>";
		        		$html .= '<div class="key">'. T_("Background"). '</div>';
		      		}
		      		$html .= '</div>';
	    		}
	    		$html .= '</li>';
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		$html .= '<div class="showColorPreview" data-kerkere-content="hide">';
		{
			$html .= '<form method="post" data-patch>';
			{
			    $html .= '<div class="text-center">';
			    {
			    	foreach (\content_site\color\color::color_name() as $color)
			    	{
			    		$html .= '<div class="grid grid-cols-10">';
				    	foreach (\content_site\color\color::color_opacity() as $opaicty)
				    	{
				    		$myColor = $color. '-'. $opaicty;
				    		$json = json_encode(['opt_background_color' => $myColor, 'need_redirect' => true]);
						    $html .= "<a data-ajaxify data-data='$json' class='h-12 bg-". $myColor. "'></a>";
				    	}
			    		$html .= '</div>';
			    	}
			    	$html .= '<div class="grid grid-cols-2">';
			    	{
				    	$myColor = 'white';
			    		$json = json_encode(['opt_background_color' => $myColor, 'need_redirect' => true]);
						$html .= "<a data-ajaxify data-data='$json' class='h-12 bg-". $myColor. "'>".T_("White")."</a>";

						$myColor = 'black';
			    		$json = json_encode(['opt_background_color' => $myColor, 'need_redirect' => true]);
						$html .= "<a data-ajaxify data-data='$json' class='h-12 text-white bg-". $myColor. "'>".T_("Black")."</a>";

			    	}
			    	$html .= '</div>';
			    }
			    $html .= '</div>';
			}
	  		$html .= '</form>';
		}
	  	$html .= '</div>';

		return $html;
	}

}
?>