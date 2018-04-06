<?php
namespace content_a\product\edit;


class view extends \content_a\main\view
{
	public function config()
	{
		$product = \dash\request::get('id');

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$this->data->cat_list     = \lib\app\product::cat_list(true);
		$this->data->company_list = \lib\app\product::company_list(true);
		$this->data->unit_list    = \lib\app\product::unit_list(true);

		$productName = '';

		if(isset($this->data->product['title']))
		{
			$productName = $this->data->product['title'];
		}

		$this->data->page['title'] = T_('General setting | :name', ['name' => $productName]);

		$this->data->page['desc']  = T_('You can have some edit on this product');

		$this->data->page['badge']['link'] = \dash\url::here(). '/product';
		$this->data->page['badge']['text'] = T_('Back to product list');
	}
}
?>
