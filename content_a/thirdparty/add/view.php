<?php
namespace content_a\thirdparty\add;


class view extends \content_a\main\view
{
	public function config()
	{
		self::set_best_title();
	}


	private function set_best_title()
	{
		// set usable variable
		$this->data->modulePath = $this->url('baseFull'). '/thirdparty';
		$this->data->moduleType = \lib\utility::get('type');

		// set default title
		$this->data->page['title'] = T_('Add new third party');
		$this->data->page['desc']  = T_('You can add new third party and after add with minimal data, we allow you to add extra detail.');
		// set badge

		$this->data->page['badge']['link'] = $this->data->modulePath;
		$this->data->page['badge']['text'] = T_('Back to third parties list');


		// for special condition
		if($this->data->moduleType)
		{
			$this->data->page['title'] = T_('List of :type', ['type' => $this->data->moduleType.'s']);
			$this->data->page['desc']  = T_('Search in list of :type, add and edit and manage them.', ['type' => $this->data->moduleType.'s']);
			$this->data->page['desc']  .= ' <a href="'. $this->data->modulePath .'" data-shortkey="121">'. T_('List of all third parties.'). '<kbd>f10</kbd></a>';


			$this->data->page['badge']['link'] = $this->data->modulePath. '/add?type='. $this->data->moduleType;
			$this->data->page['badge']['text'] = T_('Add new :type', ['type' => $this->data->moduleType]);
		}
	}
}
?>
