<?php
class view extends main_view 
{
	public function config() 
	{
		$this->global->page_title = 'Admin';
		$this->include->datatable = true;
		//$this->include->jquery = false;
	}
}
?>