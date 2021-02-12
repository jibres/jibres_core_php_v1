<?php
namespace content_r10\domain\edit;


class model
{
	// public static function delete()
	// {
	// 	$result = \lib\app\nic_domain\remove::remove(\dash\request::get('id'));
	// 	\content_r10\tools::say($result);
	// }

	public static function patch()
	{
		$patch = [];

		if(\dash\request::isset_input_body('autorenew'))  		$patch['autorenew']   	= \dash\request::input_body('autorenew');

		$result = \lib\app\nic_domain\edit::edit($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}


	public static function put()
	{
		if(!\dash\request::isset_input_body('lock'))
		{
			\dash\notif::error(T_("Please set lock status"));
			return false;
		}

		$lock = \dash\request::input_body('lock');

		$load_domain = \lib\app\nic_domain\get::get(\dash\request::get('id'));

		if(!isset($load_domain['name']))
		{
			return false;
		}

		if($lock)
		{
			$result = \lib\app\domains\lock::lock($load_domain['name']);
		}
		elseif(\dash\request::post('myaction') == 'unlock')
		{
			$result = \lib\app\domains\lock::unlock($load_domain['name']);
		}

		\content_r10\tools::say($result);
	}
}
?>