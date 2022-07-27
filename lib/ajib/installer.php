<?php
namespace lib\ajib;


use lib\app\product\variants;
use mysql_xdevapi\Exception;

class installer implements command
{
    private $args = [];
    private $command = null;
    private $username = null;
    private $password = null;
    private $host = null;
    private $sql_file = null;

    public function __construct(array $_args)
    {
        $this->args = $_args;
        $args = $_args;

        if(isset($args[0]))
        {
            $this->command = $args[0];
            unset($args[0]);
        }

        foreach ($args as $index => $arg)
        {
            if(str_starts_with($arg, '-u'))
            {
                $this->username = substr($arg, 2);
            }

            if(str_starts_with($arg, '-p'))
            {
                $this->password = substr($arg, 2);
            }

            if(str_starts_with($arg, '-h'))
            {
                $this->host = substr($arg, 2);
            }

            if($arg === '-f')
            {
                $this->sql_file = $args[$index + 1];
            }

        }

        if(!$this->username)
            $this->username = 'root';

        if(!$this->password)
            $this->password = 'root';



    }

    /**
     * @return void
     */
    public function execute(): void
    {
        switch ($this->command)
        {
            case 'db':
                $this->install_db();
                break;

            case 'business-db':
                $this->install_business_db();
                break;

            default:
                break;
        }

    }


    private function install_db() : void
    {
        $sql_file = glob(root. 'includes/database/jibres_install_db/*.sql');
        $username = $this->username;
        $password = $this->password;
        if($sql_file)
        {
            foreach ($sql_file as $filename)
            {
                $cmd = "mysql -u$username -p$password < $filename";

                exec($cmd);

            }
        }
    }



    private function install_business_db() : void
    {
        if($this->sql_file && is_file($this->sql_file))
        {
            if(!str_ends_with($this->sql_file, '.sql'))
            {
                throw new \Exception('Only sql file can be supported');
            }
            $cmd = "mysql -u{$this->username} -p{$this->password} < {$this->sql_file}";

            exec($cmd);
        }
        else
        {
            throw new \Exception('Sql file not found');
        }
    }
}

