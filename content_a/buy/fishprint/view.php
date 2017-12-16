<?php
namespace content_a\buy\fishprint;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Print factor');
		$this->data->page['desc']  = T_('You can search in list of buys, add new buy and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/buy/add';
		$this->data->page['badge']['text'] = T_('Add new buy');

		$meta         = [];

		$this->data->buy_detail = \lib\app\factor::get(['id' => \lib\utility::get('id')], $meta);

	}
}
?>
