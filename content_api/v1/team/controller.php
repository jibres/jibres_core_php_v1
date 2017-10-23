<?php
namespace content_api\v1\team;

class controller extends \addons\content_api\home\controller
{

	/**
	 * team
	 */
	public function ready()
	{
		// get team list
		$this->get('teamList')->ALL('v1/team/list');
		$this->get('teamList')->ALL('v1/teamlist');
		// get 1 team detail
		$this->get('one_team')->ALL('v1/team');
		// set team group
		// used from @jibresbot in https://t.me
		$this->post('setTelegramGroup')->ALL('v1/team/telegram/group');
		// add new team
		$this->post('team')->ALL('v1/team');
		// update old team
		$this->patch('team')->ALL('v1/team');
	}
}
?>