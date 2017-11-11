<?php
namespace content_a\product\delete;


class view extends \content_a\product\edit\view
{
	public function view_delete($_args)
	{
		$product = \lib\router::get_url(2);

		if($product)
		{
			$this->data->product = \lib\app\product::get(['id' => $product]);
		}

		$this->data->page['desc']  = T_('Manage delete setting of product like name and position, you can change another setting by choose another type of setting.');
	}
}
?>
