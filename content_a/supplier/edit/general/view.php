<?php
namespace content_a\supplier\edit\general;


class view extends \content_a\supplier\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit general information'). $this->data->page['title'];
		$this->data->page['desc']  = T_('you can edit general detail of supplier');
	}
}
?>
