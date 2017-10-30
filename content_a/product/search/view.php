<?php
namespace content_a\product\search;

class view extends \content_a\product\view
{
	/**
	 * { function_description }
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_search($_args)
	{
		$product_list = $this->model()->getListProduct();

		$this->data->product_list = $product_list;

		$this->data->page['title'] = T_('Add new product');
		$this->data->page['desc']  = T_('You can set detail of team product and assign some extra data to use later');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>