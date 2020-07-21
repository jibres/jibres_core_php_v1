<?php
namespace content_a\setting\shipping\setting;


class model
{
	public static function post()
	{
		$post                         = [];
		$post['deliverinstoreplace']  = \dash\request::post('deliverinstoreplace');
		$post['shipping_status']      = \dash\request::post('shipping_status');
		$post['sendbycourier']        = \dash\request::post('sendbycourier');
		$post['sendbycourierprice']   = \dash\request::post('sendbycourierprice');
		$post['sendbypost']           = \dash\request::post('sendbypost');
		$post['sendbypostprice']      = \dash\request::post('sendbypostprice');
		$post['sendoutcity']          = \dash\request::post('sendoutcity');
		$post['sendoutcityprice']     = \dash\request::post('sendoutcityprice');
		$post['sendoutprovince']      = \dash\request::post('sendoutprovince');
		$post['sendoutprovinceprice'] = \dash\request::post('sendoutprovinceprice');
		$post['sendoutcountry']       = \dash\request::post('sendoutcountry');
		$post['sendoutcountryprice']  = \dash\request::post('sendoutcountryprice');

		$post['freeshipping']         = \dash\request::post('freeshipping');
		$post['freeshippingprice']    = \dash\request::post('freeshippingprice');



		\lib\app\setting\set::shipping_setting($post);
	}
}
?>
