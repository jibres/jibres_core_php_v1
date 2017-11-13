<?php
namespace content_a\staff\edit\avatar;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Staff avatar');
		$this->data->page['desc']  = T_('Allow to set and change avatar of staff');
	}
}
?>
