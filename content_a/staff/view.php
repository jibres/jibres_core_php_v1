<?php
namespace content_a\staff;

class view extends \content_a\main\view
{

	/**
	 * { function_description }
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_staff($_args)
	{
		$meta                      = [];
		$meta['search']            = \lib\utility::get('search');
		$this->data->staff_list  = $this->model()->getstaffList($meta);

		if(empty($this->data->staff_list) && !\lib\utility::get('search'))
		{
			$this->redirector($this->url('base'). '/s/staff/add')->redirect();
		}

		$this->data->page['title'] = T_('Staff Database');
		$this->data->page['desc']  = T_('Search in complete archive of staff data and search in it by all data show in card.'). ' ' . T_('You can add or edit staffs also.');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>