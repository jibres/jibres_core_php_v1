<?php
namespace content_a\product\thumb;

class view extends \content_a\product\edit\view
{

	/**
	 * thumb product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_thumb($_args)
	{
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