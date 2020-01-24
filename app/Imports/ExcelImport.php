<?php

namespace App\Imports;

use App\Model\Pc;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) //rowにExcelのデータが入ってくるらしい
    {

        return new Pc([
            'user_name'          => $row[0],
            'mail_address'       => $row[1],
            'pc_name'            => $row[2],
            'office_license'     => $row[3],
            'pc_maker'           => $row[4],
            'pc_os'              => $row[6],
            'pc_cpu'             => $row[7],
            'pc_memory'          => $row[8],
            'pc_serial_number'   => $row[14],
            'antivirus_name'     => $row[10],
            // 'antivirus_limit'    => $row[11],
            'memo'               => $row[15]
        ]);
    }
}
