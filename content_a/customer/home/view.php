<?php
namespace content_a\customer\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of customers');
		$this->data->page['desc']  = T_('You can search in list of customers, add new member and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/customer/add';
		$this->data->page['badge']['text'] = T_('Add new customer');

		$meta         = [];
		$meta['type'] = 'customer';

		$this->data->customer_list = \lib\app\customer::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
