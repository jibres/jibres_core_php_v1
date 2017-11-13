<?php
namespace content_a\staff\edit\general;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit your general');
		$this->data->page['desc']  = T_('you can edit detail of staff');
	}
}
?>
