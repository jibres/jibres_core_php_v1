<?php
namespace content_site\options\image;


class image_random
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'random'));
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
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('random', T_('Shuffle images'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>