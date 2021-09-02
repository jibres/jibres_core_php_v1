<?php
namespace content_site\options\msg;


class msg
{
	public static function admin_html($_fn)
	{
		$html = '';

		$model   = \content_site\section\view::get_current_index_detail('model');
		$section = \content_site\section\view::get_current_index_detail('section');

		if(is_string($_fn))
		{
			$html .= \content_site\call_function::section_model_preview($section, $model, $_fn);
		}

		return $html;
	}
}
?>