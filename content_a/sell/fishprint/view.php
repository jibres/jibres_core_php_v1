<?php
namespace content_a\sell\fishprint;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Print factor');
		$this->data->page['desc']  = T_('You can search in list of sells, add new sell and edit existing.');

		$this->data->page['badge']['link']     = $this->url('baseFull'). '/sell/add';
		$this->data->page['badge']['text']     = T_('Add new sell');
		$this->data->page['badge']['shortkey'] = '118';

		$meta         = [];

		$this->data->sell_detail = \lib\app\factor::get(['id' => \lib\utility::get('id')], $meta);

	}
}
?>
