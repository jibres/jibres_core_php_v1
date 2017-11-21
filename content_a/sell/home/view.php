<?php
namespace content_a\sell\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of sells');
		$this->data->page['desc']  = T_('You can search in list of sells, add new sell and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/sell/add';
		$this->data->page['badge']['text'] = T_('Add new sell');

		$meta         = [];

		$this->data->sell_list = \lib\app\factor::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
