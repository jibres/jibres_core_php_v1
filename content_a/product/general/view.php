<?php
namespace content_a\product\general;

class view extends \content_a\product\view
{

	/**
	 * general product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_general($_args)
	{
		$product = \lib\router::get_url(2);

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$productName = '';
		if(isset($this->data->product['displayname']))
		{
			$productName = $this->data->product['displayname'];
		}

		$this->data->page['title'] = T_('General setting | :name', ['name' => $productName]);
		$this->data->page['desc']  = T_('Manage general setting of product like name and position, you can change another setting by choose another type of setting.');

	}

}
?>