<?php
namespace content_love\business\domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('checkdns') === 'checkdns')
		{
			$result = \lib\app\business_domain\dns::check(\dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('removedomain') === 'removedomain')
		{
			$result = \lib\app\business_domain\remove::remove(\dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
		}

	}
}
?>