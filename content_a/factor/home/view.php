<?php
namespace content_a\factor\home;


class view extends \content_a\main\view
{
	public function config()
	{
		self::set_best_title();

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}

		if(\dash\request::get('customer'))
		{
			$args['customer'] = \dash\request::get('customer');
		}

		$this->data->dataTable = \lib\app\factor::list(\dash\request::get('q'), $args);
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
		$this->data->moduleType  = \dash\request::get('type');
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
