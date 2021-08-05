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
		$data = \dash\validate::color($_data, true, ['field_title' => T_('Color')]);
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

		$html .= '<form method="post" data-patch>';
		{

	    	$html .= '<label for="color-'. $_name. '">'. $_title. '</label>';
	    	$html .= '<div>';
	    	{
	    		$html .= '<input type="color" class="circle block" name="'.$_name. '" id="color-'.$_name.'" value="'.$_default.'">';
	    	}
	    	$html .= '</div>';
		}
  		$html .= '</form>';

	  	return $html;
	}


	public static function color_text_class_name($_args)
	{
		$class = [];

		$color_text       = a($_args,  'color_text');

		if($color_text)
		{
			$class[] = 'text-'. $color_text;
		}

		$color_text_hover = a($_args,  'color_text_hover');

		if($color_text_hover)
		{
			$class[] = 'hover:text-'. $color_text_hover;
		}

		$color_text_focus = a($_args,  'color_text_focus');

		if($color_text_focus)
		{
			$class[] = 'focus:text-'. $color_text_focus;
		}

		$color_opacity    = a($_args,  'color_opacity');

		if($color_opacity)
		{
			$class[] = 'text-opacity-'. $color_opacity;
		}

		$font    = a($_args,  'font');

		if($font)
		{
			$class[] = 'font-'. $font;
		}


		return implode(' ', $class);
	}

}
?>