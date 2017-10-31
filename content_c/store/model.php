<?php
namespace content_c\store;


class model extends \content_c\main\model
{
	public function getListStore()
	{
		return \lib\app\store::list();
	}
}
?>