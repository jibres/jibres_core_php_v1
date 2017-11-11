<?php
namespace content_a\product\edit\thumb;


class view extends \content_a\main\view
{
	public function config()
	{
		$product_id          = \lib\utility::get('id');
		$this->data->product = \lib\app\product::get(['id' => $product_id]);

		if(isset($product['displayname']))
		{
			$this->data->page['title'] = T_('thumb :name', ['name' => $product['displayname']]);
		}
		else
		{
			$this->data->page['title'] = T_('thumb product!');
		}

		$this->data->page['desc']  = $this->data->page['title'];
	}
}
?>
