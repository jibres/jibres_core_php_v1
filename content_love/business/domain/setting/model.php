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

		if(\dash\request::post('changecdn') === 'changecdn')
		{
			$post =
			[
				'cdn' => \dash\request::post('cdn'),
			];


			$result = \lib\app\business_domain\edit::edit($post, \dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


		if(\dash\request::post('addtocdnpanel') === 'addtocdnpanel')
		{
			$result = \lib\app\business_domain\cdnpanel::add(\dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


		if(\dash\request::post('removefromcdnpanel') === 'removefromcdnpanel')
		{
			$result = \lib\app\business_domain\cdnpanel::remove(\dash\data::dataRow_id());
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




		if(\dash\request::post('resethttps') === 'resethttps')
		{
			$result = \lib\app\business_domain\https::reset(\dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('httpsrequest') === 'httpsrequest')
		{
			$result = \lib\app\business_domain\https::request(\dash\data::dataRow_id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}



	}
}
?>