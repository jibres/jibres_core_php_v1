<?php
namespace content_a\product\edit\delete;


class view extends \content_a\main\view
{
	public function config()
	{
		$product = \lib\utility::get('id');

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$this->data->page['title'] = T_('Delete Product');
		$this->data->page['desc']  = T_('You can delete product easily form this page, be careful!');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/product/add';
		$this->data->page['badge']['text'] = T_('Add new product');
	}
}
?>
