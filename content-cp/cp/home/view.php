<?php
class view extends main_view 
{
	public function config() 
	{
		$this->global->page_title = 'Control Panel';
		//$this->include->datatable = true;
		//$this->include->jquery = false;

		// easily show the list of folders
		$tmp		=glob("../content-cp/cp/*");
		$tmp_array	=null;
		foreach ($tmp as $i) 
		{
			$a				= explode('/', $i);
			$b				= $a[count($a)-1];
			if($b!='home')
			{
				$tmp_array[$b]= '';
			}
		}

		$this->data->tmp	= array_keys($tmp_array);
		
         // $this->createform(".login");
         // $this->data->module = "login";
		

	}
}
?>