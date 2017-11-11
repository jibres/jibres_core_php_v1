<?php
namespace content_a\product\general;


class view extends \content_a\product\edit\view
{
	public function view_general($_args)
	{
		$productTitle = '';
		if(isset($this->data->product['title']))
		{
			$productTitle = $this->data->product['title'];
		}

		$this->data->page['title'] = T_('General setting | :name', ['name' => $productTitle]);
		$this->data->page['desc']  = T_('Manage general setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.');
	}
}
?>
