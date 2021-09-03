<?php
namespace content_site\options\announcement;


class announcement_check
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'announcementcheck'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(\content_site\utility::className(__CLASS__));

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::checkbox('announcementcheck', T_('Enable announcement'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>