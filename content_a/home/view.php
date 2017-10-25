<?php
namespace content_a\home;

class view extends \content_a\main\view
{
	/**
	 * title and desc of page
	 */
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
	public function view_dashboard($_args)
	{

	}
}
?>