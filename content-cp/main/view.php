<?php
class main_view extends view_cls
{
	// ---------------------------------------------------------------- default config function for ADMIN
	public function config() 
	{
		if($this->data->module)
		{
			if($this->data->child)
			{
				// in add, edit or delete pages
				$this->data->form_title		= ucfirst($this->url_table_prefix());
				$this->global->page_title	= $this->url_title() . ' ' . $this->data->form_title;
				$myForm						= $this->createform("@".$this->data->module);
				$this->data->form_show		= true;

				
				if(isset(config_lib::$surl['edit']))
				{
					$tmp_result = $this->sql("#datarowbyid");
					$this->fill_for_edit($tmp_result, $myForm);
				}
			}
			else
			{
				// in root page like site.com/admin/banks show datatable

				// get data from database through model
				$this->data->datatable		= $this->sql("#datatable");
				if($this->data->datatable)
				{
					// get all fields of table and filter fields name for show in datatable, access from columns variable
					// check if datatable exist then get this data
					$this->include->datatable	= true;
					// $fields					= array_keys($this->data->datatable[0]);
					$fields						= getTable_cls::get($this->url_method_real());
					$this->data->columns		= array_fill_keys($fields, null);
					$this->data->slug			= null;

					foreach ($fields as $key)
					{
						if ($key!=='id' and $key!=='date_modified')
						{
							$this->data->columns[$key] = ucfirst(substr($key,strrpos($key,'_')+1));
							if ($this->data->columns[$key]==='Id')
							{
								// if this field related with other table(foreign key) only show the target table
								$this->data->columns[$key] = ucfirst(substr($key,0,strrpos($key,'_')));
							}
							// if( $key== ($this->url_table_prefix().'_slug') )
							// {
							// 	$this->data->slug 		= $key;
							// 	// var_dump($this->data->slug);
							// }
						}
					}
				}
			}
		}
	}
}
?>