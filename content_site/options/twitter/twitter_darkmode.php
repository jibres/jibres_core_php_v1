<?php
namespace content_site\options\twitter;


class twitter_darkmode
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'darkmode'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('twitter_darkmode');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$html .= \content_site\options\generate::checkbox('darkmode', T_('Dark mode'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>