<?php
namespace content_site\options\reverse;


class reverse
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'setreverse'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('reverse');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('setreverse', T_('Reverse'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>