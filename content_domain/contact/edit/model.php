<?php
namespace content_domain\contact\edit;


class model
{
	public static function post()
	{

		$post =
		[
			'title'        => \dash\request::post('title'),
			'isdefault'    => \dash\request::post('isdefault'),
		];

		$create = \lib\app\nic_contact\edit::edit($post, \dash\request::get('id'));

		if($create)
		{
			\dash\redirect::to(\dash\url::this());
		}



	}
}
?>