<?php
namespace content_b1\product\add;


class model
{
	public static function post()
	{
		$post = self::get_post();

		$result = \lib\app\product\add::add($post);

		\content_b1\tools::say($result);

	}



	public static function get_post()
	{
		if(\content_b1\tools::isset_input_body('title')) 			$post['title']        = \content_b1\tools::input_body('title');
		if(\content_b1\tools::isset_input_body('desc')) 			$post['desc']         = \content_b1\tools::input_body('desc');
		if(\content_b1\tools::isset_input_body('buyprice')) 		$post['buyprice']     = \content_b1\tools::input_body('buyprice');
		if(\content_b1\tools::isset_input_body('price')) 			$post['price']        = \content_b1\tools::input_body('price');
		if(\content_b1\tools::isset_input_body('discount')) 		$post['discount']     = \content_b1\tools::input_body('discount');
		if(\content_b1\tools::isset_input_body('vat')) 				$post['vat']          = \content_b1\tools::input_body('vat');
		if(\content_b1\tools::isset_input_body('sku')) 				$post['sku']          = \content_b1\tools::input_body('sku');
		if(\content_b1\tools::isset_input_body('barcode')) 			$post['barcode']      = \content_b1\tools::input_body('barcode');
		if(\content_b1\tools::isset_input_body('barcode2')) 		$post['barcode2']     = \content_b1\tools::input_body('barcode2');
		if(\content_b1\tools::isset_input_body('trackquantity')) 		$post['trackquantity']     = \content_b1\tools::input_body('trackquantity');
		if(\content_b1\tools::isset_input_body('weight')) 			$post['weight']       = \content_b1\tools::input_body('weight');
		if(\content_b1\tools::isset_input_body('seotitle')) 		$post['seotitle']     = \content_b1\tools::input_body('seotitle');
		if(\content_b1\tools::isset_input_body('slug')) 			$post['slug']         = \content_b1\tools::input_body('slug');
		if(\content_b1\tools::isset_input_body('type')) 			$post['type']         = \content_b1\tools::input_body('type');
		if(\content_b1\tools::isset_input_body('seodesc')) 			$post['seodesc']      = \content_b1\tools::input_body('seodesc');
		if(\content_b1\tools::isset_input_body('saleonline')) 		$post['saleonline']   = \content_b1\tools::input_body('saleonline');
		if(\content_b1\tools::isset_input_body('saletelegram')) 	$post['saletelegram'] = \content_b1\tools::input_body('saletelegram');
		if(\content_b1\tools::isset_input_body('saleapp')) 			$post['saleapp']      = \content_b1\tools::input_body('saleapp');
		if(\content_b1\tools::isset_input_body('company')) 			$post['company']      = \content_b1\tools::input_body('company');
		if(\content_b1\tools::isset_input_body('scalecode')) 		$post['scalecode']    = \content_b1\tools::input_body('scalecode');
		if(\content_b1\tools::isset_input_body('status')) 			$post['status']       = \content_b1\tools::input_body('status');
		if(\content_b1\tools::isset_input_body('minsale')) 			$post['minsale']      = \content_b1\tools::input_body('minsale');
		if(\content_b1\tools::isset_input_body('maxsale')) 			$post['maxsale']      = \content_b1\tools::input_body('maxsale');
		if(\content_b1\tools::isset_input_body('salestep')) 		$post['salestep']     = \content_b1\tools::input_body('salestep');
		if(\content_b1\tools::isset_input_body('oversale')) 		$post['oversale']     = \content_b1\tools::input_body('oversale');
		if(\content_b1\tools::isset_input_body('company')) 			$post['company']      = \content_b1\tools::input_body('company');
		if(\content_b1\tools::isset_input_body('unit')) 			$post['unit']         = \content_b1\tools::input_body('unit');
		if(\content_b1\tools::isset_input_body('cat')) 				$post['cat_id']       = \content_b1\tools::input_body('cat');
		if(\content_b1\tools::isset_input_body('tag')) 				$post['tag']          = \content_b1\tools::input_body('tag');
		if(\content_b1\tools::isset_input_body('minstock')) 		$post['minstock']     = \content_b1\tools::input_body('minstock');
		if(\content_b1\tools::isset_input_body('maxstock')) 		$post['maxstock']     = \content_b1\tools::input_body('maxstock');
		if(\content_b1\tools::isset_input_body('length')) 			$post['length']       = \content_b1\tools::input_body('length');
		if(\content_b1\tools::isset_input_body('width')) 			$post['width']        = \content_b1\tools::input_body('width');
		if(\content_b1\tools::isset_input_body('height')) 			$post['height']       = \content_b1\tools::input_body('height');
		if(\content_b1\tools::isset_input_body('filesize')) 		$post['filesize']     = \content_b1\tools::input_body('filesize');
		if(\content_b1\tools::isset_input_body('fileaddress')) 		$post['fileaddress']  = \content_b1\tools::input_body('fileaddress');

		return $post;
	}
}
?>