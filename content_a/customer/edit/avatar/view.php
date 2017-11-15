<?php
namespace content_a\customer\edit\avatar;


class view extends \content_a\customer\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit avatar'). $this->data->page['title'];
		$this->data->page['desc']  = T_('Allow to set and change avatar of customer');
	}
}
?>
