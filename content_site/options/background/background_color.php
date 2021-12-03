<?php
namespace content_site\options\background;


class background_color
{

	public static function validator($_data)
	{
		$data = \dash\validate::color($_data, true, ['field_title' => T_('Color')]);
		return $data;
	}


	public static function default()
	{
		return null;
		// return '#ffffff';
	}

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_color');

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Background Color");

		$html = static::color_html('opt_background_color', $default, $title, false, true, true);

		return $html;
	}


	/**
	 * Use in gradient and other place need color html
	 * Get option name + default value + option title to genetart color html selector
	 *
	 * @param      string  $_name     The name
	 * @param      string  $_default  The default
	 */
	public static function color_html($_name, $_default, $_title, $_only_input = false, $_show_label = true, $_random_color = false)
	{
		$block_class = null;
		$form_class  = 'inline-block pe-3 mT0-f';

		if(!$_only_input)
		{
			$block_class = 'block';
			$form_class  = null;
		}

		$input = '<input type="color" class="picker mRa10 mB10 align-middle '.$block_class.'" name="'.$_name. '" id="color-'.$_name.'"';
		if($_default)
		{
			$input .= ' value="'. $_default. '"';
		}
		$input .= '>';


		$html = '';

		$html .= \content_site\options\generate::form($form_class);
		{
			if($_show_label)
			{
	    		$html .= '<label class="block" for="color-'. $_name. '">'. $_title. '</label>';
	    		$html .= $input;
			}
			else
			{
				$html .= $input;
			}

			if($_random_color)
			{
				$html .= background_color_random::admin_html_solid();
			}

		}
  		$html .= \content_site\options\generate::_form();

	  	return $html;
	}
}
?>