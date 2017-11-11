<?php
namespace content_a\product\edit;


class view extends \content_a\main\view
{
	public function config()
	{
		$product = \lib\router::get_url(2);

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$productName = '';

		if(isset($this->data->product['title']))
		{
			$productName = $this->data->product['title'];
		}

		$this->data->page['title'] = T_('General setting | :name', ['name' => $productName]);
	}


	public function view_edit($_args)
	{
		$this->data->page['title'] = T_('Special Access');
		$this->data->page['desc']  = T_('You can set some edit to product to do some more activity in Tejarak.');
	}

}
?>
