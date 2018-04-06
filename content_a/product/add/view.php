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
		if(\dash\request::get('barcode'))
		{
			$this->data->product['barcode'] = \dash\request::get('barcode');
		}
		if(\dash\request::get('barcode2'))
		{
			$this->data->product['barcode2'] = \dash\request::get('barcode2');
		}
		if(\dash\request::get('price'))
		{
			$this->data->product['price'] = \dash\request::get('price');
		}
		if(\dash\request::get('discount'))
		{
			$this->data->product['discount'] = \dash\request::get('discount');
		}
		if(\dash\request::get('buyprice'))
		{
			$this->data->product['buyprice'] = \dash\request::get('buyprice');
		}
		if(\dash\request::get('title'))
		{
			$this->data->product['title'] = \dash\request::get('title');
		}
	}
}
?>
