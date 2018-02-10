<?php
namespace content_a\factor\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of factors');
		$this->data->page['desc']  = T_('You can search in list of factors, add new factor and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/factor/add';
		$this->data->page['badge']['text'] = T_('Add new factor');

		// add back to product list link
		$product_list_link =  '<a href="'. $this->url('baseFull') .'/factor" data-shortkey="121">'. T_('Back to factor list'). ' <kbd>f10</kbd></a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$args =
		[
			'order' => \lib\utility::get('order'),
			'sort'  => \lib\utility::get('sort'),
		];

		if(\lib\utility::get('type'))
		{
			$args['type'] = \lib\utility::get('type');
		}

		$this->data->factor_list = \lib\app\factor::list(\lib\utility::get('search'), $args);


		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, $this->url('baseFull'). '/factor');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
