<?php
namespace content_api\v6\product;


class add
{
	public static function route()
	{
		if(\dash\request::is('post'))
		{
			return self::add();
		}
		else
		{
			\content_api\v6::stop(405);
		}
	}


	private static function add()
	{
		$post                   = [];
		$post['title']          = \dash\request::post('title');
		$post['slug']           = \dash\request::post('slug');
		$post['shortcode']      = \dash\request::post('shortcode');
		$post['barcode']        = \dash\request::post('barcode');
		$post['barcode2']       = \dash\request::post('barcode2');
		$post['buyprice']       = \dash\request::post('buyprice');
		$post['price']          = \dash\request::post('price');
		$post['discount']       = \dash\request::post('discount');
		$post['discount']       = \dash\request::post('discount');
		$post['vat']            = \dash\request::post('vat');
		$post['initialbalance'] = \dash\request::post('initialbalance');
		$post['minstock']       = \dash\request::post('minstock');
		$post['maxstock']       = \dash\request::post('maxstock');
		$post['status']         = \dash\request::post('status');
		$post['sold']           = \dash\request::post('sold');
		$post['stock']          = \dash\request::post('stock');
		$post['service']        = \dash\request::post('service');
		$post['saleonline']     = \dash\request::post('saleonline');
		$post['salestore']      = \dash\request::post('salestore');
		$post['carton']         = \dash\request::post('carton');
		$post['quickcode']      = \dash\request::post('quickcode');
		$post['desc']           = \dash\request::post('desc');
		$post['scalecode']      = \dash\request::post('scalecode');
		$post['thumb']          = \dash\request::post('thumb');
		$post['salesite']       = \dash\request::post('salesite');
		$post['saletelegram']   = \dash\request::post('saletelegram');
		$post['saleapp']        = \dash\request::post('saleapp');
		$post['salephysical']   = \dash\request::post('salephysical');
		$post['weight']         = \dash\request::post('weight');
		$post['infinite']       = \dash\request::post('infinite');

		$result = \lib\app\product::add($post);

		return $result;
	}
}
?>