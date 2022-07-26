<?php
namespace lib\ajib;


class detect
{
	public $commad = null;
	public $args = [];

	public function __construct($_args)
	{
		if(isset($_args[1]))
		{
			$this->commad = $_args[1];
		}

        foreach ($_args as $key => $value)
        {
            if($key > 1)
            {
                $this->args[] = $value;
            }
        }


		if(!$this->commad)
		{
			return throw new \Exception("Ajib argument is required", 1);
		}
	}


	public function go() : void
	{
		switch ($this->commad)
		{
			case 'install':
				$ok = (new \lib\ajib\installer)->execute($this->args);
				break;

			default:
				throw new \Exception("Invalid ajib argument", 1);
				break;
		}
	}
}
