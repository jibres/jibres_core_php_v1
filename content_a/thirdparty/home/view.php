<?php
namespace content_a\thirdparty\home;


class view extends \content_a\main\view
{
	public function config()
	{
		self::set_best_title();

		$args = [];

		$type = \dash\request::get('type');

		if($type && in_array($type, ['customer', 'staff', 'supplier']))
		{
			$args[$type] = 1;
		}

		$args['order'] = 'desc';
		$this->data->dataTable = \lib\app\thirdparty::list(\dash\request::get('q'), $args);
		$this->data->dataFilter = $this->createFilterMsg($args);

		$this->data->dashboard_detail = \lib\app\store::dashboard_detail(\lib\store::id());

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}



	private function set_best_title()
	{
		// set usable variable
		$this->data->moduleType = \dash\request::get('type');

		// set default title
		$this->data->page['title'] = T_('List of third parties');
		$this->data->page['desc']  = T_('All type of poeple or companies like customers, staffs and supplisers is known as third parties that work with your store is exist here');
		// set badge
		$this->data->page['badge']['link'] = \dash\url::this(). '/add';
		$this->data->page['badge']['text'] = T_('Add new third party');


		// for special condition
		if($this->data->moduleType)
		{
			$this->data->page['title'] = T_('List of :type', ['type' => $this->data->moduleType.'s']);
			$this->data->page['desc']  = T_('Search in list of :type, add and edit and manage them.', ['type' => $this->data->moduleType.'s']);
			$this->data->page['desc']  .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all third parties.'). '<kbd>f10</kbd></a>';


			$this->data->page['badge']['link'] = \dash\url::this(). '/add?type='. $this->data->moduleType;
			$this->data->page['badge']['text'] = T_('Add new :type', ['type' => $this->data->moduleType]);
		}

	}
}
?>
