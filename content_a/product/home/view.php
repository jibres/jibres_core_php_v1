<?php
namespace content_a\product\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/product/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'   => \lib\utility::get('order'),
			'sort'    => \lib\utility::get('sort'),
			'barcode' => \lib\utility::get('barcode'),
		];

		$this->data->product_list  = \lib\app\product::list(\lib\utility::get('q'), $args);

		if(\lib\utility::get('json') === 'true')
		{
			echo json_encode($this->data->product_list, JSON_UNESCAPED_UNICODE);
			\lib\code::exit();
		}

		$this->data->sort_link = self::make_sort_link(\lib\app\product::$sort_field, $this->url('baseFull'). '/product');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}


	public static function make_sort_link($_field, $_url)
	{
		$get = \lib\utility::get(null, 'raw');
		if(!is_array($get))
		{
			$get = [];
		}

		$default_get =
		[
			'q'     => null,
			'sort'  => null,
			'order' => null,
		];

		$get          = array_merge($default_get, $get);
		$get['order'] = mb_strtolower($get['order']);
		$get['sort']  = mb_strtolower($get['sort']);

		$link = [];

		foreach ($_field as $key => $field)
		{
			$temp_link         = [];
			$temp_link['sort'] = $field;

			if($field === $get['sort'])
			{
				$temp_link['order'] = 'asc';
				if($get['order'] === 'asc')
				{
					$temp_link['order'] = 'desc';
				}
				$link[$field]['order'] = $temp_link['order'] === 'asc' ? 'desc' : 'asc';
			}
			else
			{
				$temp_link['order']    = 'asc';
				$link[$field]['order'] = null;
			}

			$temp_link['q']    = $get['q'];

			$link[$field]['link'] = $_url . '?'.  http_build_query($temp_link);
		}
		return $link;
	}
}
?>
