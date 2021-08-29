<?php
namespace content_site\options\quote;


class quote_random
{
	public static function validator($_data)
	{
		$data = \dash\validate::bool(a($_data, 'random'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('quote_random');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_quote_random" value="1">';

			$html .= \content_site\options\generate::checkbox('random', T_('Shuffle quotes'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>