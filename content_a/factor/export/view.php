<?php
namespace content_a\factor\export;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Print factor');
		$this->data->page['desc']  = T_('You can search in list of factors, add new factor and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/factor';
		$this->data->page['badge']['text'] = T_('Back to last sales');

		$meta         = [];

		$this->data->factor_detail = \lib\app\factor::get(['id' => \lib\utility::get('id')], $meta);

		$this->data->pageSize = \lib\utility::get('size');
	}
}
?>
