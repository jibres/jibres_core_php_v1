<?php
namespace content_my\business\creating;


class model
{
	public static function post()
	{
		if(\dash\request::post('create') === 'store')
		{
			\content_my\business\creating::cross_step('creating');
		}
	}
}
?>
