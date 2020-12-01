<?php
namespace content_crm\member\mobile;


class model
{

	/**
	 * Posts an addmember.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function post()
	{

		$post =
		[
			'mobile' => \dash\request::post('mobile'),
		];

		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>