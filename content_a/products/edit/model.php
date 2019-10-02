<?php
namespace content_a\products\edit;


class model
{

	public static function get_post()
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
		$post['variants']        = \dash\request::post('variants');
		$post['optionname1']     = \dash\request::post('optionname1');
		$post['optionvalue1']    = \dash\request::post('optionvalue1');
		$post['optionname2']     = \dash\request::post('optionname2');
		$post['optionvalue2']    = \dash\request::post('optionvalue2');
		$post['optionname3']     = \dash\request::post('optionname3');
		$post['optionvalue3']    = \dash\request::post('optionvalue3');
		$post['seotitle']        = \dash\request::post('seotitle');
		$post['slug']            = \dash\request::post('slug');
		$post['type']            = \dash\request::post('type');
		$post['excerpt']         = \dash\request::post('excerpt');
		$post['saleonline']      = \dash\request::post('saleonline');
		$post['saletelegram']    = \dash\request::post('saletelegram');
		$post['saleapp']         = \dash\request::post('saleapp');
		$post['publishdatetype'] = \dash\request::post('publishdatetype');
		$post['publishdate']     = \dash\request::post('publishdate');
		$post['publishtime']     = \dash\request::post('publishtime');
		$post['company']         = \dash\request::post('company');
		$post['scalecode']       = \dash\request::post('scalecode');
		$post['status']          = \dash\request::post('status');

		return $post;
	}


	public static function post()
	{
		$post = self::get_post();

		$id = \dash\request::post('id');

		$result = \lib\app\product2\edit::edit($post, $id);
		if(!$result)
		{
			return false;
		}

		\dash\redirect::pwd();
	}
}
?>