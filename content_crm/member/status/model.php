<?php
namespace content_crm\member\status;


class model
{

	/**
	 * Posts an addmember.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function post()
	{

		if(\dash\request::post('resetban') === 'resetban')
		{
			$post =
			[
				'status' => 'awaiting',
				'ban_expire' => null,
			];

		}
		elseif(\dash\request::post('remove') === 'remove')
		{
			$post =
			[
				'status' => 'removed',
			];
		}
		else
		{
			$post =
			[
				'status' => \dash\request::post('status'),
			];
		}

		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>