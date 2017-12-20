<?php
namespace content_a\product\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new product or goods');
		$this->data->page['desc']  = T_('You can set main property of product and allow to assign some extra or edit it later.');

		// add back to product list link
		$product_list_link =  '<a href="'. $this->url('baseFull') .'/product" data-shortkey="117">'. T_('Back to product list'). '</a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$this->data->cat_list     = \lib\app\product::cat_list(true);
		$this->data->company_list = \lib\app\product::company_list(true);
		$this->data->unit_list    = \lib\app\product::unit_list(true);

		// get some value from get
		if(\lib\utility::get('barcode'))
		{
			$this->data->product['barcode'] = \lib\utility::get('barcode');
		}
		if(\lib\utility::get('barcode2'))
		{
			$this->data->product['barcode2'] = \lib\utility::get('barcode2');
		}
		if(\lib\utility::get('price'))
		{
			$this->data->product['price'] = \lib\utility::get('price');
		}
		if(\lib\utility::get('discount'))
		{
			$this->data->product['discount'] = \lib\utility::get('discount');
		}
		if(\lib\utility::get('buyprice'))
		{
			$this->data->product['buyprice'] = \lib\utility::get('buyprice');
		}
		if(\lib\utility::get('title'))
		{
			$this->data->product['title'] = \lib\utility::get('title');
		}
	}
}
?>
