<?php

namespace Database\Seeders;

class ImportCSV 
{
    public static function csv_to_array($filename='', $delimiter=';')
        {
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;

            $header = NULL;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 2000, $delimiter)) !== FALSE)
                {
                    if(!$header)
                        $header = $row;
                    else
                                //$data[] = array_combine($header, $row);
                        $count = '';
                    $count = min(count($header), count($row));
                    $data[] = array_combine(array_slice($header, 0, $count), array_slice($row, 0, $count));
                }
                fclose($handle);
            }
            return $data;
        }
} 