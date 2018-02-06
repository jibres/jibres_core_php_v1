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

		// add back to product list link
		$product_list_link =  '<a href="'. $this->url('baseFull') .'/factor" data-shortkey="121">'. T_('Back to factor list'). ' <kbd>f10</kbd></a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$args =
		[
			'order' => \lib\utility::get('order'),
			'sort'  => \lib\utility::get('sort'),
		];

		$this->data->sell_list = \lib\app\factor::list(\lib\utility::get('search'), $args);

		if(!\lib\utility::get('search') && !$this->data->sell_list)
		{
			$this->redirector($this->url('baseFull'). '/sell/add')->redirect();
		}

		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, $this->url('baseFull'). '/sell');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
