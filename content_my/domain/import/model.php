<?php
namespace content_my\domain\import;


class model
{
	public static function post()
	{

		$post =
		[
			'domains' => \dash\request::post('domains'),
			'autorenew' => \dash\request::post('autorenew'),
		];

		$result = \lib\app\nic_domain\import::import($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>