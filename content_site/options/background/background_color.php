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

		$color_ajax = \dash\url::here(). '/color?json=1';

		$title = T_("Background Color");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    $html .= '<input type="hidden" name="option" value="background_color">';
			$html .= "<label for='background_color'>$title</label>";
	    $html .= '<select name="background_color" class="select22" data-model="ajax" data-ajax--url="'.$color_ajax.'" data-ajax--cache="true" id="background_color">';

	    // set default value
	    if(false)
	    {
	    	$html .= "<option value='gray-500' selected >gray-500</option>";
	    }

      // foreach (self::enum() as $key => $value)
      // {
      // 	$selected = null;

      // 	if($value['color'] === $default)
      // 	{
      // 		$selected = ' selected';
      // 	}

      // 	$html .= "<option value='$value[color]'$selected>";
      // 	$html .= $value['color'];
      // 	// $html .= "<div class='$value[color]'>salam</div>";
      // 	$html .= "</option>";
      // }

	    $html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>