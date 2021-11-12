<?php
namespace content_site\options\video;


trait video_autoplay
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'video_autoplay'));
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

		$default = \content_site\section\view::get_current_index_detail('video_autoplay');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::checkbox('video_autoplay',  T_('Auto play'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>