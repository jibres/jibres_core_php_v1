<?php
namespace content_site\options\slider;


class slider_next_prev
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'next_prev'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('slider_next_prev');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('next_prev',  T_('Next prev'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>