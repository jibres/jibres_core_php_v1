<?php
namespace content_a\setting\shipping;


class model
{
	public static function post()
	{
		$post                         = [];

		if(\dash\request::post('set_shipping_status'))
		{
			$post['shipping_status']      = \dash\request::post('shipping_status');
		}

		if(\dash\request::post('set_deliverinstoreplace'))
		{
			$post['deliverinstoreplace']  = \dash\request::post('deliverinstoreplace');
		}

		// $post['sendbycourier']        = \dash\request::post('sendbycourier');
		// $post['sendbycourierprice']   = \dash\request::post('sendbycourierprice');

		if(\dash\request::post('set_sendbypostprice'))
		{
			$post['sendbypost']           = \dash\request::post('sendbypostprice') ? true : false;
			$post['sendbypostprice']      = \dash\request::post('sendbypostprice');
		}

		// $post['sendoutcity']          = \dash\request::post('sendoutcity');
		// $post['sendoutcityprice']     = \dash\request::post('sendoutcityprice');

		// $post['sendoutprovince']      = \dash\request::post('sendoutprovince');
		// $post['sendoutprovinceprice'] = \dash\request::post('sendoutprovinceprice');

		// $post['sendoutcountry']       = \dash\request::post('sendoutcountry');
		// $post['sendoutcountryprice']  = \dash\request::post('sendoutcountryprice');

		if(\dash\request::post('set_freeshippingprice'))
		{
			$post['freeshipping']         = \dash\request::post('freeshippingprice') ? true : false;
			$post['freeshippingprice']    = \dash\request::post('freeshippingprice');
		}




		\lib\app\setting\set::shipping_setting($post);
	}
}
?>
