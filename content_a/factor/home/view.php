<?php
namespace content_a\factor\home;


class view extends \content_a\main\view
{
	public function config()
	{
		self::set_best_title();

		$args =
		[
			'order' => \lib\utility::get('order'),
			'sort'  => \lib\utility::get('sort'),
		];

		if(\lib\utility::get('type'))
		{
			$args['type'] = \lib\utility::get('type');
		}


		if(\lib\utility::get('customer'))
		{
			$args['customer'] = \lib\utility::get('customer');
		}

		$this->data->dataTable = \lib\app\factor::list(\lib\utility::get('q'), $args);


		$this->data->sort_link = self::make_sort_link(\lib\app\factor::$sort_field, $this->url('baseFull'). '/factor');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}

	private function set_best_title()
	{
		// set usable variable
		$this->data->modulePath  = $this->url('baseFull'). '/factor';
		$this->data->moduleType  = \lib\utility::get('type');
		$this->data->moduleTypeP = '?type='. $this->data->moduleType;

		// set default title
		$this->data->page['title'] = T_('List of factors');
		$this->data->page['desc']  = T_('You can search in list of factors, add new factor or edit existing.');
		// set badge
		$this->data->page['badge']['link'] = $this->data->modulePath. '/summary';
		$this->data->page['badge']['text'] = T_('Back to factors summary');


		// // for special condition
		if($this->data->moduleType)
		{
			$this->data->page['title'] = T_('List of :type', ['type' => $this->data->moduleType]);
			$this->data->page['desc']  = T_('Search in list of :type factors, add or edit them.', ['type' => $this->data->moduleType]);
			$this->data->page['desc']  .= ' <a href="'. $this->data->modulePath .'" data-shortkey="121">'. T_('List of all factors.'). '<kbd>f10</kbd></a>';


			$this->data->page['badge']['link'] = $this->data->modulePath. '/add?type='. $this->data->moduleType;
			$this->data->page['badge']['text'] = T_('Add new :type', ['type' => $this->data->moduleType]);
		}
	}
}
?>
