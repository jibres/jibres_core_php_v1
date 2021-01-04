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
		if(\dash\request::isset_input_body('title')) 			$post['title']        = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('desc')) 			$post['desc']         = \dash\request::input_body('desc');
		if(\dash\request::isset_input_body('buyprice')) 		$post['buyprice']     = \dash\request::input_body('buyprice');
		if(\dash\request::isset_input_body('price')) 			$post['price']        = \dash\request::input_body('price');
		if(\dash\request::isset_input_body('discount')) 		$post['discount']     = \dash\request::input_body('discount');
		if(\dash\request::isset_input_body('vat')) 				$post['vat']          = \dash\request::input_body('vat');
		if(\dash\request::isset_input_body('sku')) 				$post['sku']          = \dash\request::input_body('sku');
		if(\dash\request::isset_input_body('barcode')) 			$post['barcode']      = \dash\request::input_body('barcode');
		if(\dash\request::isset_input_body('barcode2')) 		$post['barcode2']     = \dash\request::input_body('barcode2');
		if(\dash\request::isset_input_body('trackquantity')) 		$post['trackquantity']     = \dash\request::input_body('trackquantity');
		if(\dash\request::isset_input_body('weight')) 			$post['weight']       = \dash\request::input_body('weight');
		if(\dash\request::isset_input_body('seotitle')) 		$post['seotitle']     = \dash\request::input_body('seotitle');
		if(\dash\request::isset_input_body('slug')) 			$post['slug']         = \dash\request::input_body('slug');
		if(\dash\request::isset_input_body('type')) 			$post['type']         = \dash\request::input_body('type');
		if(\dash\request::isset_input_body('seodesc')) 			$post['seodesc']      = \dash\request::input_body('seodesc');
		if(\dash\request::isset_input_body('saleonline')) 		$post['saleonline']   = \dash\request::input_body('saleonline');
		if(\dash\request::isset_input_body('saletelegram')) 	$post['saletelegram'] = \dash\request::input_body('saletelegram');
		if(\dash\request::isset_input_body('saleapp')) 			$post['saleapp']      = \dash\request::input_body('saleapp');
		if(\dash\request::isset_input_body('company')) 			$post['company']      = \dash\request::input_body('company');
		if(\dash\request::isset_input_body('scalecode')) 		$post['scalecode']    = \dash\request::input_body('scalecode');
		if(\dash\request::isset_input_body('status')) 			$post['status']       = \dash\request::input_body('status');
		if(\dash\request::isset_input_body('minsale')) 			$post['minsale']      = \dash\request::input_body('minsale');
		if(\dash\request::isset_input_body('maxsale')) 			$post['maxsale']      = \dash\request::input_body('maxsale');
		if(\dash\request::isset_input_body('salestep')) 		$post['salestep']     = \dash\request::input_body('salestep');
		if(\dash\request::isset_input_body('oversale')) 		$post['oversale']     = \dash\request::input_body('oversale');
		if(\dash\request::isset_input_body('company')) 			$post['company']      = \dash\request::input_body('company');
		if(\dash\request::isset_input_body('unit')) 			$post['unit']         = \dash\request::input_body('unit');
		if(\dash\request::isset_input_body('cat')) 				$post['cat_id']       = \dash\request::input_body('cat');
		if(\dash\request::isset_input_body('tag')) 				$post['tag']          = \dash\request::input_body('tag');
		if(\dash\request::isset_input_body('minstock')) 		$post['minstock']     = \dash\request::input_body('minstock');
		if(\dash\request::isset_input_body('maxstock')) 		$post['maxstock']     = \dash\request::input_body('maxstock');
		if(\dash\request::isset_input_body('length')) 			$post['length']       = \dash\request::input_body('length');
		if(\dash\request::isset_input_body('width')) 			$post['width']        = \dash\request::input_body('width');
		if(\dash\request::isset_input_body('height')) 			$post['height']       = \dash\request::input_body('height');
		if(\dash\request::isset_input_body('filesize')) 		$post['filesize']     = \dash\request::input_body('filesize');
		if(\dash\request::isset_input_body('fileaddress')) 		$post['fileaddress']  = \dash\request::input_body('fileaddress');

		return $post;
	}
}
?>