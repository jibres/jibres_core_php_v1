<?php
namespace content_a\products\cartlimit;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                    = [];

		$post['company']         = \dash\request::post('company');
		$post['length']          = \dash\request::post('length');
		$post['width']           = \dash\request::post('width');
		$post['height']          = \dash\request::post('height');
		$post['weight']          = \dash\request::post('weight');
		$post['filesize']        = \dash\request::post('filesize');
		$post['fileaddress']     = \dash\request::post('fileaddress');

		$post['minsale']         = \dash\request::post('minsale');
		$post['maxsale']         = \dash\request::post('maxsale');
		$post['salestep']        = \dash\request::post('salestep');
		$post['preparationtime'] = \dash\request::post('preparationtime');





		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>