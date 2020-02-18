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

		$file1     = \dash\upload\user::indenfity_set('file1');

		// we have an error in upload file1
		if($file1 === false)
		{
			return false;
		}

		$file2     = \dash\upload\user::indenfity_set('file2');

		// we have an error in upload file2
		if($file2 === false)
		{
			return false;
		}

		$post                 = [];
		if($file1)
		{
			$post['file1'] = $file1;
		}

		if($file2)
		{
			$post['file2'] = $file2;
		}

		// $post['nationality']  = \dash\request::post('nationality');
		// $post['birthcity']    = \dash\request::post('birthplace');
		// $post['issueplace']   = \dash\request::post('issueplace');
		// $post['shcode']       = \dash\request::post('shcode');
		// $post['pasportcode']  = \dash\request::post('pasportcode');
		// $post['pasportdate']  = \dash\request::post('passportdate');
		// $post['nationalcode'] = \dash\request::post('nationalcode');
		// $post['shfrom']       = \dash\request::post('shfrom');

		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{

			\dash\redirect::pwd();
		}
	}


}
?>
