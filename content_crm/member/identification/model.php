<?php
namespace content_crm\member\identification;


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
			'firstname'    => \dash\request::post('name'),
			'lastname'     => \dash\request::post('lastName'),
			'father'       => \dash\request::post('father'),
			'marital'      => \dash\request::post('marital'),
			'birthday'     => \dash\request::post('birthday'),
			'gender'       => \dash\request::post('gender'),
			'nationality'  => \dash\request::post('nationality'),
			'nationalcode' => \dash\request::post('nationalcode'),
			'pasportcode'  => \dash\request::post('pasportcode'),
			'pasportdate'  => \dash\request::post('passportdate'),
		];

		// $file1     = \dash\upload\user::indenfity_set('file1');
		// $file2     = \dash\upload\user::indenfity_set('file2');

		// if($file1)
		// {
		// 	$post['file1'] = $file1;
		// }

		// if($file2)
		// {
		// 	$post['file2'] = $file2;
		// }

		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{

			\dash\redirect::pwd();
		}
	}


}
?>
