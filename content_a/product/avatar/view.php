<?php
namespace content_a\product\avatar;

class view extends \content_a\product\view
{

	/**
	 * avatar product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_avatar($_args)
	{
		if(isset($product['displayname']))
		{
			$this->data->page['title'] = T_('avatar :name', ['name' => $product['displayname']]);
		}
		else
		{
			$this->data->page['title'] = T_('avatar product!');
		}
		$this->data->page['desc']  = $this->data->page['title'];

	}

}
?>