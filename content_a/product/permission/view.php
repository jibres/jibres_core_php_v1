<?php
namespace content_a\product\permission;

class view extends \content_a\product\view
{

	/**
	 * permission product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_permission($_args)
	{
		$this->data->page['title'] = T_('Special Access');
		$this->data->page['desc']  = T_('You can set some permission to product to do some more activity in Tejarak.');
	}

}
?>