<?php
namespace content_a\buy\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of buys');
		$this->data->page['desc']  = T_('You can search in list of buys, add new buy and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/buy/add';
		$this->data->page['badge']['text'] = T_('Add new buy');

		$args =
		[
			'order' => \lib\utility::get('order'),
			'sort'  => \lib\utility::get('sort'),
			'type'  => 'buy',
		];

		$this->data->buy_list = \lib\app\factor::list(\lib\utility::get('search'), $args);

		if(!\lib\utility::get('search') && !$this->data->buy_list)
		{
			$this->redirector($this->url('baseFull'). '/buy/add')->redirect();
		}

		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, $this->url('baseFull'). '/buy');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
