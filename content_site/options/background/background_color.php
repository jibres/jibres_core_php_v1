<?php
namespace content_site\options\background;


class background_color
{

	public static function enum()
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


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_color');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Background Color");

		$html = self::color_html('opt_background_color', $default, $title);

		return $html;
	}


	/**
	 * Use in gradient and other place need color html
	 * Get option name + default value + option title to genetart color html selector
	 *
	 * @param      string  $_name     The name
	 * @param      string  $_default  The default
	 */
	public static function color_html($_name, $_default, $_title)
	{
		$html = '';
		$html .= '<nav class="items mT20">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
		      		$html .= "<div class='item f' data-kerkere='.showColorPreview_". $_name. "'>";
		      		{
		        		$html .= "<div title='$_default' class='h-12 w-20 bg-". $_default. "'></div>";
		        		$html .= '<div class="key">'. $_title. '</div>';
		      		}
		      		$html .= '</div>';
	    		}
	    		$html .= '</li>';
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		$html .= '<div class="showColorPreview_'.$_name.'" data-kerkere-content="hide">';
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
							$json    = json_encode([$_name => $myColor,]);
							$html    .= "<a data-ajaxify data-data='$json' title='$myColor' class='h-12 bg-". $myColor. "'></a>";
				    	}
			    		$html .= '</div>';
			    	}
			    	$html .= '<div class="grid grid-cols-2">';
			    	{
						$myColor = 'white';
						$json    = json_encode([$_name => $myColor,]);
						$html    .= "<a data-ajaxify data-data='$json' title='$myColor' class='h-12 bg-". $myColor. "'>".T_("White")."</a>";

						$myColor = 'black';
						$json    = json_encode([$_name => $myColor,]);
						$html    .= "<a data-ajaxify data-data='$json' title='$myColor' class='h-12 text-white bg-". $myColor. "'>".T_("Black")."</a>";

						$myColor = 'transparent';
						$json    = json_encode([$_name => $myColor,]);
						$html    .= "<a data-ajaxify data-data='$json' title='$myColor' class='h-12 text-white bg-". $myColor. "'>".T_("transparent")."</a>";

						$myColor = 'current';
						$json    = json_encode([$_name => $myColor,]);
						$html    .= "<a data-ajaxify data-data='$json' title='$myColor' class='h-12 text-white bg-". $myColor. "'>".T_("current")."</a>";

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