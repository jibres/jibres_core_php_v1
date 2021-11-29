<?php
namespace content_site\options\twitter;


class twitter_show_detail
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'twdisplaydetail'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('twitter_show_detail');
		if(is_null($default))
		{
			$default = true;
		}

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$html .= \content_site\options\generate::checkbox('twdisplaydetail', T_('Display detail'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>