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

		$args =
		[
			'order' => \lib\utility::get('order'),
			'sort'  => \lib\utility::get('sort'),
		];

		$this->data->sell_list = \lib\app\factor::list(\lib\utility::get('search'), $args);

		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, $this->url('baseFull'). '/sell');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
