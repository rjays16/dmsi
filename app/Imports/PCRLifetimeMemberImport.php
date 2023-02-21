<?php

namespace App\Imports;

use App\Models\PCRMember;
use Maatwebsite\Excel\Concerns\ToModel;

class PCRLifetimeMemberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PCRMember([
            'last_name' => $row[1],
            'middle_name' => $row[3],
            'first_name' => $row[2],
            'email' => '',
            'prc_number' => 'N/A',
            'is_trainee' => 0,
            'address' => 'N/A'
        ]);
    }
}
