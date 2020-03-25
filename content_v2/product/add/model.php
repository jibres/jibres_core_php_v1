<?php
namespace content_v2\product\add;


class model
{
	public static function post()
	{
		$post = self::get_post();

		$result = \lib\app\product\add::add($post);

		\content_v2\tools::say($result);

	}



	public static function get_post()
	{
		$post                    = [];

		if(\content_v2\tools::isset_input_body('title')) 			$post['title']           = \content_v2\tools::input_body('title');
		if(\content_v2\tools::isset_input_body('desc')) 			$post['desc']            = \content_v2\tools::input_body('desc');
		if(\content_v2\tools::isset_input_body('buyprice')) 		$post['buyprice']        = \content_v2\tools::input_body('buyprice');
		if(\content_v2\tools::isset_input_body('price')) 			$post['price']           = \content_v2\tools::input_body('price');
		if(\content_v2\tools::isset_input_body('discount')) 		$post['discount']        = \content_v2\tools::input_body('discount');
		if(\content_v2\tools::isset_input_body('vat')) 				$post['vat']             = \content_v2\tools::input_body('vat');
		if(\content_v2\tools::isset_input_body('sku')) 				$post['sku']             = \content_v2\tools::input_body('sku');
		// if(\content_v2\tools::isset_input_body('code')) 			$post['code']            = \content_v2\tools::input_body('code');
		if(\content_v2\tools::isset_input_body('barcode')) 			$post['barcode']         = \content_v2\tools::input_body('barcode');
		if(\content_v2\tools::isset_input_body('barcode2')) 		$post['barcode2']        = \content_v2\tools::input_body('barcode2');
		if(\content_v2\tools::isset_input_body('infinite')) 		$post['infinite']        = \content_v2\tools::input_body('infinite');
		// if(\content_v2\tools::isset_input_body('gallery')) 			$post['gallery']         = \content_v2\tools::input_body('gallery');
		if(\content_v2\tools::isset_input_body('weight')) 			$post['weight']          = \content_v2\tools::input_body('weight');
		// if(\content_v2\tools::isset_input_body('weightunit')) 		$post['weightunit']      = \content_v2\tools::input_body('weightunit');
		if(\content_v2\tools::isset_input_body('seotitle')) 		$post['seotitle']        = \content_v2\tools::input_body('seotitle');
		if(\content_v2\tools::isset_input_body('slug')) 			$post['slug']            = \content_v2\tools::input_body('slug');
		if(\content_v2\tools::isset_input_body('type')) 			$post['type']            = \content_v2\tools::input_body('type');
		if(\content_v2\tools::isset_input_body('seodesc')) 			$post['seodesc']         = \content_v2\tools::input_body('seodesc');
		if(\content_v2\tools::isset_input_body('saleonline')) 		$post['saleonline']      = \content_v2\tools::input_body('saleonline');
		if(\content_v2\tools::isset_input_body('saletelegram')) 	$post['saletelegram']    = \content_v2\tools::input_body('saletelegram');
		if(\content_v2\tools::isset_input_body('saleapp')) 			$post['saleapp']         = \content_v2\tools::input_body('saleapp');
		// if(\content_v2\tools::isset_input_body('publishdatetype')) 	$post['publishdatetype'] = \content_v2\tools::input_body('publishdatetype');
		// if(\content_v2\tools::isset_input_body('publishdate')) 		$post['publishdate']     = \content_v2\tools::input_body('publishdate');
		// if(\content_v2\tools::isset_input_body('publishtime')) 		$post['publishtime']     = \content_v2\tools::input_body('publishtime');
		if(\content_v2\tools::isset_input_body('company')) 			$post['company']         = \content_v2\tools::input_body('company');
		if(\content_v2\tools::isset_input_body('scalecode')) 		$post['scalecode']       = \content_v2\tools::input_body('scalecode');
		if(\content_v2\tools::isset_input_body('status')) 			$post['status']          = \content_v2\tools::input_body('status');
		if(\content_v2\tools::isset_input_body('minsale')) 			$post['minsale']         = \content_v2\tools::input_body('minsale');
		if(\content_v2\tools::isset_input_body('maxsale')) 			$post['maxsale']         = \content_v2\tools::input_body('maxsale');
		if(\content_v2\tools::isset_input_body('salestep')) 		$post['salestep']        = \content_v2\tools::input_body('salestep');
		if(\content_v2\tools::isset_input_body('oversale')) 		$post['oversale']        = \content_v2\tools::input_body('oversale');
		if(\content_v2\tools::isset_input_body('company')) 			$post['company']         = \content_v2\tools::input_body('company');
		if(\content_v2\tools::isset_input_body('unit')) 			$post['unit']            = \content_v2\tools::input_body('unit');
		if(\content_v2\tools::isset_input_body('cat')) 				$post['cat_id']        = \content_v2\tools::input_body('cat');
		if(\content_v2\tools::isset_input_body('tag')) 				$post['tag']             = \content_v2\tools::input_body('tag');

		return $post;
	}
}
?>