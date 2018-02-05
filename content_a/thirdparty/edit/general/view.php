<?php
namespace content_a\thirdparty\edit\general;


class view extends \content_a\thirdparty\edit\view
{
	public function config()
	{
		self::load_thirdparty_detail();

		$this->data->page['title'] = T_('Edit general information'). $this->data->page['title'];
		$this->data->page['desc']  = T_('you can edit general detail of thirdparty');
	}
}
?>
