<?php
namespace content_site\options\checklist;


class checklist_status extends \content_site\options\link\link_color
{

	public static function link_color()
	{
		$list = [];
		$list[] = ['key' => 'primary', ];
		// $list[] = ['key' => 'secondary', ];
		$list[] = ['key' => 'success', ];
		$list[] = ['key' => 'danger', ];
		$list[] = ['key' => 'warning', ];
		// $list[] = ['key' => 'info', ];
		// $list[] = ['key' => 'light', ];
		// $list[] = ['key' => 'dark', ];
		return $list;
	}



	public static function db_key()
	{
		return 'link_color';
	}


	public static function title()
	{
		return T_("Status");
	}

}
?>
