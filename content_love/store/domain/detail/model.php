<?php
namespace content_love\store\domain\detail;


class model
{
	public static function post()
	{
		if(\dash\request::post('send') === 'again')
		{
			$domain = \dash\request::post('domain');
			$result = \lib\app\store\domain::add_domain_arvan($domain);
			return $result;
		}

		if(\dash\request::post('setstatus') === 'setstatus')
		{
			$post = [];
			$post['status'] = \dash\request::post('status');
			\lib\app\store\domain::edit_record($post, \dash\request::get('id'));
			\dash\redirect::pwd();
		}

		if(\dash\request::post('send') === 'reset')
		{
			$post                   = [];
			$post['status']         = null;
			$post['cronjobdate']    = null;
			$post['cronjobstatus']  = null;
			$post['sslrequestdate'] = null;
			$post['message'] = null;

			\lib\app\store\domain::edit_record($post, \dash\request::get('id'));
			\dash\redirect::pwd();
		}
	}
}
?>