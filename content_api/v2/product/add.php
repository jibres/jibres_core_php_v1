<?php
namespace content_api\v2\product;


class add
{
	public static function route_add()
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

	public static function route_edit($_product_id)
	{
		if(\dash\request::is('patch'))
		{
			$detail = self::edit($_product_id);
			\content_api\v2::say($detail);
		}
		else
		{
			\content_api\v2::invalid_method();
		}
	}


	private static function edit($_product_id)
	{
		$post = self::get_post();
		parse_str(file_get_contents('php://input'), $_PATCH);
		j($_PATCH);
		j(file_get_contents("php://input"));
		$result = \lib\app\product\edit::edit($post, $_product_id);

		if(!$result)
		{
			return false;
		}

		return $result;
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
		$post['title']           = \content_api\v2::input_body('title');
		$post['desc']            = \content_api\v2::input_body('desc') ? $_POST['desc'] : null;
		$post['buyprice']        = \content_api\v2::input_body('buyprice');
		$post['price']           = \content_api\v2::input_body('price');
		$post['discount']        = \content_api\v2::input_body('discount');
		$post['vat']             = \content_api\v2::input_body('vat');
		$post['sku']             = \content_api\v2::input_body('sku');
		$post['code']            = \content_api\v2::input_body('code');
		$post['barcode']         = \content_api\v2::input_body('barcode');
		$post['barcode2']        = \content_api\v2::input_body('barcode2');
		$post['infinite']        = \content_api\v2::input_body('infinite');
		$post['gallery']         = \content_api\v2::input_body('gallery');
		$post['weight']          = \content_api\v2::input_body('weight');
		$post['weightunit']      = \content_api\v2::input_body('weightunit');
		$post['seotitle']        = \content_api\v2::input_body('seotitle');
		$post['slug']            = \content_api\v2::input_body('slug');
		$post['type']            = \content_api\v2::input_body('type');
		$post['seodesc']         = \content_api\v2::input_body('seodesc');
		$post['saleonline']      = \content_api\v2::input_body('saleonline');
		$post['saletelegram']    = \content_api\v2::input_body('saletelegram');
		$post['saleapp']         = \content_api\v2::input_body('saleapp');
		$post['publishdatetype'] = \content_api\v2::input_body('publishdatetype');
		$post['publishdate']     = \content_api\v2::input_body('publishdate');
		$post['publishtime']     = \content_api\v2::input_body('publishtime');
		$post['company']         = \content_api\v2::input_body('company');
		$post['scalecode']       = \content_api\v2::input_body('scalecode');
		$post['status']          = \content_api\v2::input_body('status');
		$post['minsale']         = \content_api\v2::input_body('minsale');
		$post['maxsale']         = \content_api\v2::input_body('maxsale');
		$post['salestep']        = \content_api\v2::input_body('salestep');
		$post['oversale']        = \content_api\v2::input_body('oversale');
		$post['company']         = \content_api\v2::input_body('company');
		$post['unit']            = \content_api\v2::input_body('unit');
		$post['category']        = \content_api\v2::input_body('cat');
		$post['tag']             = \content_api\v2::input_body('tag');

		return $post;
	}
}
?>