<?php
namespace content_a\product\add;

class view extends \content_a\product\view
{
	/**
	 * { function_description }
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_add($_args)
	{
		$this->data->page['title'] = T_('Add new product');
		$this->data->page['desc']  = T_('You can set detail of team product and assign some extra data to use later');
	}
}
?>