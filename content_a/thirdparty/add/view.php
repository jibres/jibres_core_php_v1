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
		$this->data->moduleType = \lib\request::get('type');

		// set default title
		$this->data->page['title'] = T_('Add new third party');
		$this->data->page['desc']  = T_('You can add new third party and after add with minimal data, we allow you to add extra detail.');
		// set badge

		$this->data->page['badge']['link'] = \dash\url::this();
		$this->data->page['badge']['text'] = T_('Back to third parties list');


		// for special condition
		if($this->data->moduleType)
		{
			$this->data->page['title'] = T_('Add new :type', ['type' => $this->data->moduleType.'s']);
			$this->data->page['desc']  = T_('Add new :type with minmal data and after that you can add extra detail.', ['type' => $this->data->moduleType]);


			$this->data->page['badge']['link'] = \dash\url::this(). '?type='. $this->data->moduleType;
			$this->data->page['badge']['text'] = T_('Back to :type', ['type' => $this->data->moduleType]);
		}
	}
}
?>
