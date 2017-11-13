<?php
namespace content_a\staff\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of staffs');
		$this->data->page['desc']  = T_('You can search in list of staffs, add new member and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/staff/add';
		$this->data->page['badge']['text'] = T_('Add new staff');

		$meta         = [];
		$meta['type'] = 'staff';

		$this->data->staff_list = \lib\app\staff::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
