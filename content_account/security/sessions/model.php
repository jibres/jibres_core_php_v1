<?php
namespace content_account\security\sessions;


class model
{

	public static function post()
	{

		if(\dash\request::post('type') === 'terminateall')
		{
			\dash\login::terminate_all_other_session(\dash\user::id());

			\dash\redirect::pwd();
			return true;
		}

		if(\dash\request::post('type') === 'terminate' && \dash\request::post('id') && is_numeric(\dash\request::post('id')))
		{
			if(\dash\login::terminate_id(\dash\request::post('id'), \dash\user::id()))
			{
				\dash\redirect::pwd();
				return true;
			}
		}
	}
}
?>