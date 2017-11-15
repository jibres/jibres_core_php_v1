<?php
namespace content_a\supplier\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of suppliers');
		$this->data->page['desc']  = T_('You can search in list of suppliers, add new member and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/supplier/add';
		$this->data->page['badge']['text'] = T_('Add new supplier');

		$meta         = [];
		$meta['type'] = 'supplier';

		$this->data->supplier_list = \lib\app\supplier::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
