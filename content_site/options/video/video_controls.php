<?php
namespace content_site\options\video;


trait video_controls
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'video_controls'));
		return $data;
	}


	public static function have_specialsave()
	{
		return false;
	}


	public static function visible()
	{
		return true;
	}


	public static function admin_html()
	{
		if(!self::visible())
		{
			return '';
		}

		$default = \content_site\section\view::get_current_index_detail('video_controls');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::checkbox('video_controls',  T_('Controls'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>