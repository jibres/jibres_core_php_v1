<?php
namespace lib\app\plan\feature;

class allowedFileSize
{

	private $size = null;


	public function __construct($_init)
	{
		if(isset($_init['size']))
		{
			$this->size = $_init['size'];
		}
	}

	public function group()
	{
		return T_("Feature");
	}


	public function title()
	{
		return T_("Allowed file upload size");
	}


	public function value()
	{
		return \dash\fit::file_size($this->size);

	}


}