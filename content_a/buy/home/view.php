<?php
namespace content_a\buy\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of buys');
		$this->data->page['desc']  = T_('You can search in list of buys, add new member and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/buy/add';
		$this->data->page['badge']['text'] = T_('Add new buy');

		$meta         = [];
		$meta['type'] = 'buy';

		// $this->data->buy_list = \lib\app\buy::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
