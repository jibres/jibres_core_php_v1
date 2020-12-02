<?php
namespace content_crm\member\sessions;


class model
{

	/**
	 * Posts a user add.
	 */
	public static function post()
	{

		$user_id = \dash\coding::decode(\dash\request::get('id'));

		if(\dash\request::post('type') === 'terminate' && \dash\request::post('id') && is_numeric(\dash\request::post('id')))
		{
			if(\dash\login::terminate_id(\dash\request::post('id'), $user_id))
			{
				\dash\redirect::pwd();
				return true;
			}
		}

	}
}
?>