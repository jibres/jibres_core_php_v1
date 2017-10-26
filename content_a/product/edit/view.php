<?php
namespace content_a\product\edit;

class view extends \content_a\product\view
{

	/**
	 * edit product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_edit($_args)
	{
		$this->data->page['title'] = T_('Special Access');
		$this->data->page['desc']  = T_('You can set some edit to product to do some more activity in Tejarak.');
	}

}
?>