<?php
namespace dash\utility;

class export
{
    private static $temp_file = null;


    /**
     * export data to csv file
     *
     * @param      <type>  $_args  The arguments
     * @param       $_arg['name']   [name of file]
     * @param       $_arg['type']   [type of file]
     * @param       $_arg['data']   [data to export]
     */
    public static function csv($_args)
    {

        $type     = isset($_args['type']) ? $_args['type'] : 'csv';
        $filename = isset($_args['name']) ? $_args['name'] : 'Untitled';

        if(isset($_args['data']) && is_array($_args['data']))
        {
            $data = $_args['data'];
        }
        else
        {
            $data = [];
        }

        // disable caching
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Type: application/csv;charset=UTF-8");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}.{$type}");
        // header("Content-Transfer-Encoding: binary");

        if (count($data) == 0 || !$data || empty($data) || !is_array($data))
        {
            echo  null;
        }
        else
        {
            // BOM header UTF-8
            echo "\xEF\xBB\xBF";

            ob_start();
            $df = @fopen("php://output", 'w');
            if(is_array(reset($data)))
            {
                $keys = array_keys(reset($data));
                // $keys = array_map('T_', $keys);

                fputcsv($df, $keys);
            }

            foreach ($data as $row)
            {
                if(!is_array($row))
                {
                    $row = [$row];
                }
                fputcsv($df, $row);
            }

            fclose($df);
            echo ob_get_clean();
        }

        \dash\code::bye();
    }




    public static function csv_file($_args, $_file, $_first_record = false)
    {
        $type         = isset($_args['type']) ? $_args['type'] : 'csv';
        $filename     = isset($_args['name']) ? $_args['name'] : 'Untitled';

        if($_first_record)
        {
            // BOM header UTF-8
            \dash\file::write($_file, "\xEF\xBB\xBF");
        }


        if(isset($_args['data']) && is_array($_args['data']))
        {
            $data = $_args['data'];
        }
        else
        {
            $data = [];
        }


        if(count($data) == 0 || !$data || empty($data) || !is_array($data))
        {
            return;
        }
        else
        {
            ob_start();

            $df = @fopen("php://output", 'w');

            if($_first_record)
            {
                if(is_array(reset($data)))
                {
                    $keys = array_keys(reset($data));
                    fputcsv($df, $keys);
                }
            }

            foreach ($data as $row)
            {
                if(!is_array($row))
                {
                    $row = [$row];
                }
                fputcsv($df, $row);
            }

            fclose($df);

            \dash\file::append($_file, ob_get_clean());
        }

    }

}
?>