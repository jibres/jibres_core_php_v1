<?php
namespace content_api\v1\user;


class add
{
	public static function route_add()
	{
		if(\dash\request::is('post'))
		{
			$detail = self::add();
			\content_api\v1\tools::say($detail);
		}
		else
		{
			\content_api\v1\tools::invalid_method();
		}
	}

	public static function route_edit($_product_id)
	{
		if(\dash\request::is('patch'))
		{
			$detail = self::edit($_product_id);
			\content_api\v1\tools::say($detail);
		}
		else
		{
			\content_api\v1\tools::invalid_method();
		}
	}


	private static function edit($_product_id)
	{
		$post = self::get_post();

		$result = \lib\app\product\edit::edit($post, $_product_id);

		if(!$result)
		{
			return false;
		}

		return $result;
	}


	private static function add()
	{
		$post           = [];
		$post['mobile'] = \content_api\v1\tools::input_body('mobile');

		$result = \dash\app\user::add($post);

		if(!$result)
		{
			return false;
		}

		unset($result['user_id']);

		return $result;
	}


	private static function get_post()
	{
		$post                    = [];

		if(\content_api\v1\tools::isset_input_body('title')) 				$post['title']           = \content_api\v1\tools::input_body('title');
		if(\content_api\v1\tools::isset_input_body('desc')) 				$post['desc']            = \content_api\v1\tools::input_body('desc') ? $_POST['desc'] : null;
		if(\content_api\v1\tools::isset_input_body('buyprice')) 			$post['buyprice']        = \content_api\v1\tools::input_body('buyprice');
		if(\content_api\v1\tools::isset_input_body('price')) 				$post['price']           = \content_api\v1\tools::input_body('price');
		if(\content_api\v1\tools::isset_input_body('discount')) 			$post['discount']        = \content_api\v1\tools::input_body('discount');
		if(\content_api\v1\tools::isset_input_body('vat')) 				$post['vat']             = \content_api\v1\tools::input_body('vat');
		if(\content_api\v1\tools::isset_input_body('sku')) 				$post['sku']             = \content_api\v1\tools::input_body('sku');
		if(\content_api\v1\tools::isset_input_body('code')) 				$post['code']            = \content_api\v1\tools::input_body('code');
		if(\content_api\v1\tools::isset_input_body('barcode')) 			$post['barcode']         = \content_api\v1\tools::input_body('barcode');
		if(\content_api\v1\tools::isset_input_body('barcode2')) 			$post['barcode2']        = \content_api\v1\tools::input_body('barcode2');
		if(\content_api\v1\tools::isset_input_body('infinite')) 			$post['infinite']        = \content_api\v1\tools::input_body('infinite');
		if(\content_api\v1\tools::isset_input_body('gallery')) 			$post['gallery']         = \content_api\v1\tools::input_body('gallery');
		if(\content_api\v1\tools::isset_input_body('weight')) 			$post['weight']          = \content_api\v1\tools::input_body('weight');
		if(\content_api\v1\tools::isset_input_body('weightunit')) 		$post['weightunit']      = \content_api\v1\tools::input_body('weightunit');
		if(\content_api\v1\tools::isset_input_body('seotitle')) 			$post['seotitle']        = \content_api\v1\tools::input_body('seotitle');
		if(\content_api\v1\tools::isset_input_body('slug')) 				$post['slug']            = \content_api\v1\tools::input_body('slug');
		if(\content_api\v1\tools::isset_input_body('type')) 				$post['type']            = \content_api\v1\tools::input_body('type');
		if(\content_api\v1\tools::isset_input_body('seodesc')) 			$post['seodesc']         = \content_api\v1\tools::input_body('seodesc');
		if(\content_api\v1\tools::isset_input_body('saleonline')) 		$post['saleonline']      = \content_api\v1\tools::input_body('saleonline');
		if(\content_api\v1\tools::isset_input_body('saletelegram')) 		$post['saletelegram']    = \content_api\v1\tools::input_body('saletelegram');
		if(\content_api\v1\tools::isset_input_body('saleapp')) 			$post['saleapp']         = \content_api\v1\tools::input_body('saleapp');
		if(\content_api\v1\tools::isset_input_body('publishdatetype')) 	$post['publishdatetype'] = \content_api\v1\tools::input_body('publishdatetype');
		if(\content_api\v1\tools::isset_input_body('publishdate')) 		$post['publishdate']     = \content_api\v1\tools::input_body('publishdate');
		if(\content_api\v1\tools::isset_input_body('publishtime')) 		$post['publishtime']     = \content_api\v1\tools::input_body('publishtime');
		if(\content_api\v1\tools::isset_input_body('company')) 			$post['company']         = \content_api\v1\tools::input_body('company');
		if(\content_api\v1\tools::isset_input_body('scalecode')) 			$post['scalecode']       = \content_api\v1\tools::input_body('scalecode');
		if(\content_api\v1\tools::isset_input_body('status')) 			$post['status']          = \content_api\v1\tools::input_body('status');
		if(\content_api\v1\tools::isset_input_body('minsale')) 			$post['minsale']         = \content_api\v1\tools::input_body('minsale');
		if(\content_api\v1\tools::isset_input_body('maxsale')) 			$post['maxsale']         = \content_api\v1\tools::input_body('maxsale');
		if(\content_api\v1\tools::isset_input_body('salestep')) 			$post['salestep']        = \content_api\v1\tools::input_body('salestep');
		if(\content_api\v1\tools::isset_input_body('oversale')) 			$post['oversale']        = \content_api\v1\tools::input_body('oversale');
		if(\content_api\v1\tools::isset_input_body('company')) 			$post['company']         = \content_api\v1\tools::input_body('company');
		if(\content_api\v1\tools::isset_input_body('unit')) 				$post['unit']            = \content_api\v1\tools::input_body('unit');
		if(\content_api\v1\tools::isset_input_body('cat')) 				$post['category']        = \content_api\v1\tools::input_body('cat');
		if(\content_api\v1\tools::isset_input_body('tag')) 				$post['tag']             = \content_api\v1\tools::input_body('tag');

		return $post;
	}
}
?>