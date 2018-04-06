<?php
namespace content_a\factor\fishprint;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Print factor');
		$this->data->page['desc']  = T_('You can search in list of factors, add new factor and edit existing.');

		$this->data->page['badge']['link'] = \dash\url::here(). '/factor';
		$this->data->page['badge']['text'] = T_('Back to last sales');

		$meta         = [];

		$this->data->factor_detail = \lib\app\factor::get(['id' => \dash\request::get('id')], $meta);

		$this->data->pageSize = \dash\request::get('size');


		// add to factor main
		$this->data->template['fishprint'] = 'content_a/factor/fishprint/fishprint.html';
	}
}
?>
