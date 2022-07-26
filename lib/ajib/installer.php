<?php
namespace lib\ajib;


class installer implements command
{

    /**
     * @return void
     */
    public function execute(array $_args): void
    {
        switch ($_args[0])
        {
            case 'db':
                $this->install_db($_args);
                break;

            default:
                break;
        }

    }


    private function install_db(array $_args) : void
    {
        $sql_file = glob(root. 'includes/database/jibres_install_db/*.sql');
        $username = 'root';
        if(isset($_args[1]))
        {
            $username = $_args[1];
        }

        $password = 'root';
        if(isset($_args[2]))
        {
            $password = $_args[2];
        }
        if($sql_file)
        {
            foreach ($sql_file as $filename)
            {
                $cmd = "mysql -u$username -p$password < $filename";

                exec($cmd);

            }
        }
    }
}

