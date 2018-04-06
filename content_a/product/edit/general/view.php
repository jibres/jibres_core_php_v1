<?php
namespace content_a\product\edit\general;


class view extends \content_a\main\view
{
	public function config()
	{
		$product_id          = \lib\request::get('id');
		$this->data->product = \lib\app\product::get(['id' => $product_id]);

		$this->data->cat_list     = \lib\app\product::cat_list(true);
		$this->data->company_list = \lib\app\product::company_list(true);
		$this->data->unit_list    = \lib\app\product::unit_list(true);

		$productTitle = '';
		if(isset($this->data->product['title']))
		{
			$productTitle = $this->data->product['title'];
		}

		$this->data->page['title'] = T_('General setting | :name', ['name' => $productTitle]);
		$this->data->page['desc']  = T_('Manage general setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.');

		// add back to product list link
		// $product_list_link =  '<a href="'. \dash\url::here() .'/product" data-shortkey="118">'. T_('Back to product list'). '</a>';
		// $this->data->page['desc']  .= ' '. $product_list_link;


		$this->data->page['badge']['link'] = \dash\url::here(). '/product';
		$this->data->page['badge']['text'] = T_('Back to product list');
	}
}
?>
