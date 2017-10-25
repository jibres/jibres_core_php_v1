<?php
namespace content_c\store;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Dashboard");
		$this->data->page['desc'] = T_("View team summary and add new team or change it");
	}


	/**
	 * view all team and branch
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_list($_args)
	{
		$list_store = $this->model()->getListStore();
		$this->data->list_store = $list_store;
	}
}
?>