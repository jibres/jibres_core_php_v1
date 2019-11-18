<?php
namespace content_api\v2\product;


class add
{
	public static function route()
	{
		if(\dash\request::is('post'))
		{
			$detail = self::add();
			\content_api\v2::say($detail);
		}
		else
		{
			\content_api\v2::invalid_method();
		}
	}


	private static function add()
	{
		$post = self::get_post();

		$result = \lib\app\product\add::add($post);

		if(!$result)
		{
			return false;
		}

		return $result;
	}


	private static function get_post()
	{
		$post                    = [];
		$post['title']           = \dash\request::post('title');
		$post['desc']            = \dash\request::post('desc') ? $_POST['desc'] : null;
		$post['buyprice']        = \dash\request::post('buyprice');
		$post['price']           = \dash\request::post('price');
		$post['discount']        = \dash\request::post('discount');
		$post['vat']             = \dash\request::post('vat');
		$post['sku']             = \dash\request::post('sku');
		$post['code']            = \dash\request::post('code');
		$post['barcode']         = \dash\request::post('barcode');
		$post['barcode2']        = \dash\request::post('barcode2');
		$post['infinite']        = \dash\request::post('infinite');
		$post['gallery']         = \dash\request::post('gallery');
		$post['weight']          = \dash\request::post('weight');
		$post['weightunit']      = \dash\request::post('weightunit');
		$post['seotitle']        = \dash\request::post('seotitle');
		$post['slug']            = \dash\request::post('slug');
		$post['type']            = \dash\request::post('type');
		$post['seodesc']         = \dash\request::post('seodesc');
		$post['saleonline']      = \dash\request::post('saleonline');
		$post['saletelegram']    = \dash\request::post('saletelegram');
		$post['saleapp']         = \dash\request::post('saleapp');
		$post['publishdatetype'] = \dash\request::post('publishdatetype');
		$post['publishdate']     = \dash\request::post('publishdate');
		$post['publishtime']     = \dash\request::post('publishtime');
		$post['company']         = \dash\request::post('company');
		$post['scalecode']       = \dash\request::post('scalecode');
		$post['status']          = \dash\request::post('status');
		$post['minsale']         = \dash\request::post('minsale');
		$post['maxsale']         = \dash\request::post('maxsale');
		$post['salestep']        = \dash\request::post('salestep');
		$post['oversale']        = \dash\request::post('oversale');
		$post['company']         = \dash\request::post('company');
		$post['unit']            = \dash\request::post('unit');
		$post['category']        = \dash\request::post('cat');
		$post['tag']             = \dash\request::post('tag');

		return $post;
	}
}
?>