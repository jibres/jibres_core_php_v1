<?php
namespace content_a\product\observer;

class view extends \content_a\product\view
{

	/**
	 * observer product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_observer($_args)
	{

		$this->data->product_parent = $this->model()->getParent();

		$this->data->page['title'] = T_('Observer or parents');
		$this->data->page['desc']  = T_('After each activity like enter or exit of this product, we are send notify via Telegram or if not present via sms to defined observer.');
	}
}
?>