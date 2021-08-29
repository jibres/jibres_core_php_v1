<?php
namespace content_site\options\description;

/**
 * Use in another option
 */
trait description
{

	public static function validator($_data)
	{
		$data = \dash\validate::desc($_data);
		return $data;
	}

	public static function db_key()
	{
		return 'description';
	}


	public static function title()
	{
		return T_("Description");
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::not_redirect();
	    	$html .= '<label for="description">'. self::title(). '</label>';
	    	$html .= '<textarea class="txt" name="opt_'.\content_site\utility::className(__CLASS__).'" rows="3">';
	    	$html .= $default;
	    	$html .= '</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>