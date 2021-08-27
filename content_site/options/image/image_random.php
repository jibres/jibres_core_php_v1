<?php
namespace content_site\options\image;


class image_random
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'random'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('image_random');



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_image_random" value="1">';

			$html .= \content_site\options\generate::checkbox('random', T_('Show random image'), $default);
		}

  		$html .= '</form>';

		return $html;
	}

}
?>