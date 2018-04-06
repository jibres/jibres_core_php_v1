<?php
namespace content_a\product\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new product or goods');
		$this->data->page['desc']  = T_('You can set main property of product and allow to assign some extra or edit it later.');

		$this->data->page['badge']['link'] = \dash\url::here(). '/product';
		$this->data->page['badge']['text'] = T_('Back to product list');

		$this->data->cat_list     = \lib\app\product::cat_list(true);
		$this->data->company_list = \lib\app\product::company_list(true);
		$this->data->unit_list    = \lib\app\product::unit_list(true);

		// get some value from get
		if(\lib\request::get('barcode'))
		{
			$this->data->product['barcode'] = \lib\request::get('barcode');
		}
		if(\lib\request::get('barcode2'))
		{
			$this->data->product['barcode2'] = \lib\request::get('barcode2');
		}
		if(\lib\request::get('price'))
		{
			$this->data->product['price'] = \lib\request::get('price');
		}
		if(\lib\request::get('discount'))
		{
			$this->data->product['discount'] = \lib\request::get('discount');
		}
		if(\lib\request::get('buyprice'))
		{
			$this->data->product['buyprice'] = \lib\request::get('buyprice');
		}
		if(\lib\request::get('title'))
		{
			$this->data->product['title'] = \lib\request::get('title');
		}
	}
}
?>
