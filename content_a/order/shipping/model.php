<?php
namespace content_a\order\shipping;


class model
{

	public static function post()
	{


		$post =
		[
			'package'       => \dash\request::post('package'),
			'custompackage' => \dash\request::post('custompackage'),
			'saveforlater'  => \dash\request::post('saveforlater'),
			'weight'        => \dash\request::post('weight'),
			'method'        => \dash\request::post('method'),
			'shippingdate'  => \dash\request::post('shippingdate'),
			'length'        => \dash\request::post('length'),
			'width'         => \dash\request::post('width'),
			'height'        => \dash\request::post('height'),
		];

		\lib\app\factor\edit::edit_address($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
