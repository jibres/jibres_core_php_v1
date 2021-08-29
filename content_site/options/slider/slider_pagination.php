<?php
namespace content_site\options\slider;


class slider_pagination
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'pagination'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('slider_pagination');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$html .= \content_site\options\generate::checkbox('pagination',  T_('Pagination'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>