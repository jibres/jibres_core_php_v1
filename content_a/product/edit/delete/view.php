<?php
namespace content_a\product\edit\delete;


class view extends \content_a\main\view
{
	public function config()
	{
		$product = \lib\request::get('id');

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$this->data->page['title'] = T_('Delete Product');
		$this->data->page['desc']  = T_('You can delete product easily form this page, be careful!');

		$this->data->page['badge']['link'] = \dash\url::here(). '/product';
		$this->data->page['badge']['text'] = T_('Back to product list');
	}
}
?>
