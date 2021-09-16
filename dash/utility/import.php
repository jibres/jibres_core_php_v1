<?php
namespace dash\utility;

class import
{
    /**
    *   import data from csv to array
    */
    public static function csv($_file, $_limit = null)
    {
        if(!is_string($_file))
        {
            return false;
        }

        $header = [];
        $data   = [];
        $i      = 0;

        if(($handle = fopen($_file, "r")) !== false)
        {
            while(($one_rows = fgetcsv($handle, 0, ",", '"', "\\")) !== false)
            {
                if(empty($header))
                {
                    $header = $one_rows;
                }
                else
                {
                    $data[] = $one_rows;
                }

                if($_limit)
                {
                    $i++;

                    if($i > $_limit)
                    {
                        break;
                    }
                }
            }
            fclose($handle);
        }

        $result = [];

        foreach ($data as $key => $value)
        {
            if(count($value) === count($header))
            {
                $result[]  = array_combine($header, $value);
            }
            else if(count($value) < count($header))
            {
                $filledLine = [];
                for ($i=0; $i < count($header); $i++)
                {
                    if(array_key_exists($i, $value))
                    {
                        $filledLine[$i] = $value[$i];
                    }
                    else
                    {
                        $filledLine[] = null;
                    }
                }
                $result[]  = array_combine($header, $filledLine);
            }
        }
        return $result;
    }
}
?>