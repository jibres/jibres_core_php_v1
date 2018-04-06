<?php
namespace content_a\factor\home;


class view extends \content_a\main\view
{
	public function config()
	{
		self::set_best_title();

		$args =
		[
			'order' => \lib\request::get('order'),
			'sort'  => \lib\request::get('sort'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\lib\request::get('type'))
		{
			$args['type'] = \lib\request::get('type');
		}

		if(\lib\request::get('customer'))
		{
			$args['customer'] = \lib\request::get('customer');
		}

		$this->data->dataTable = \lib\app\factor::list(\lib\request::get('q'), $args);
		$this->data->dataFilter = $this->createFilterMsg($args);
		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, \dash\url::here(). '/factor');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}


	private function set_best_title()
	{
		// set usable variable
		$this->data->moduleType  = \lib\request::get('type');
		$this->data->moduleTypeP = '?type='. $this->data->moduleType;

		// set default title
		$this->data->page['title'] = T_('List of factors');
		$this->data->page['desc']  = T_('You can search in list of factors, add new factor or edit existing.');
		// set badge
		$this->data->page['badge']['link'] = \dash\url::this(). '/summary';
		$this->data->page['badge']['text'] = T_('Back to factors summary');


		// // for special condition
		if($this->data->moduleType)
		{
			$this->data->page['title'] = T_('List of :type', ['type' => $this->data->moduleType]);
			$this->data->page['desc']  = T_('Search in list of :type factors, add or edit them.', ['type' => $this->data->moduleType]);
			$this->data->page['desc']  .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all factors.'). '<kbd>f10</kbd></a>';


			$this->data->page['badge']['link'] = \dash\url::this(). '/add?type='. $this->data->moduleType;
			$this->data->page['badge']['text'] = T_('Add new :type', ['type' => $this->data->moduleType]);
		}
	}
}
?>
