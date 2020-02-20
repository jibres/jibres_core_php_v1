<?php
namespace content_my\domain\dns\edit;


class model
{
	public static function post()
	{
		if(\dash\request::post('myaction') === 'remove')
		{

			$create = \lib\app\nic_dns\edit::remove(\dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
			return;
		}

		$post =
		[
			'title'     => \dash\request::post('title'),
			'ns1'       => \dash\request::post('ns1'),
			'ns2'       => \dash\request::post('ns2'),
			'ip1'       => \dash\request::post('ip1'),
			'ip2'       => \dash\request::post('ip2'),
			'ns3'       => \dash\request::post('ns3'),
			'ns4'       => \dash\request::post('ns4'),
			'ip3'       => \dash\request::post('ip3'),
			'ip4'       => \dash\request::post('ip4'),
			'isdefault' => \dash\request::post('isdefault'),
		];


		$create = \lib\app\nic_dns\edit::edit($post, \dash\request::get('id'));

		if($create && \dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>