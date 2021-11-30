<?php
namespace content_site\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('customize') === 'display')
		{
			if(\dash\request::post('viewmode') === 'mobile')
			{
				\content_site\utility::set_iframe_on('mobile');
			}

			if(\dash\request::post('viewmode') === 'desktop')
			{
				\content_site\utility::set_iframe_on('desktop');
			}
		}

		\dash\notif::complete();
	}
}
?>