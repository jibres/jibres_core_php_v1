<?php
namespace content_a\product\personal;

class view extends \content_a\product\view
{

	/**
	 * personal product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_personal($_args)
	{
		if(isset($product['displayname']))
		{
			$this->data->page['title'] = T_('personal :name', ['name' => $product['displayname']]);
		}
		else
		{
			$this->data->page['title'] = T_('personal product!');
		}
		$this->data->page['desc']  = $this->data->page['title'];

	}

}
?>