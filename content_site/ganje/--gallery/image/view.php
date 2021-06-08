<?php
namespace content_site\section\gallery\image;


class view extends \content_site\section\gallery\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Gallery image'));

		\dash\data::back_link(\dash\url::that(). \dash\request::full_get(['image' => null]));

	}

}
?>