<?php
namespace content_a\products\organization;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                = [];

		$post['unit']        = \dash\request::post('unit') ? \dash\request::post('unit') : null;
		$post['type']        = \dash\request::post('type');
		$post['filesize']    = \dash\request::post('filesize');
		$post['fileaddress'] = \dash\request::post('fileaddress');

		$post['minsale']     = \dash\request::post('minsale');
		$post['maxsale']     = \dash\request::post('maxsale');
		$post['salestep']    = \dash\request::post('salestep');
		// $post['preparationtime'] = \dash\request::post('preparationtime');


		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>