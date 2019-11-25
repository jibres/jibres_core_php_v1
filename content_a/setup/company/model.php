<?php
namespace content_a\setup\company;


class model
{
	public static function post()
	{
		$post                          = [];
		$post['companyeconomiccode']   = \dash\request::post('companyeconomiccode');
		$post['companynationalid']     = \dash\request::post('companynationalid');
		$post['companyregisternumber'] = \dash\request::post('companyregisternumber');
		$post['ceonationalcode']       = \dash\request::post('ceonationalcode');
		$post['companyname']           = \dash\request::post('companyname');


		\lib\app\setting\setup::save_company($post);
		\lib\store::refresh();
		// save every field in somewhere and set the company detail is complete
		$next_level = \lib\app\setting\setup::company();
		\dash\redirect::to($next_level);
	}
}
?>
