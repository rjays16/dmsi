<?php

namespace App\Imports;

use App\Models\PCRMember;
use App\Services\OrderService;

use Maatwebsite\Excel\Concerns\ToModel;

class PCRMembersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $exists = PCRMember::where('email', $row[5])->first();
        if(isset($row[0])) {
            if($row[0] === "user") {
                $pcr_member = new PCRMember();
                $pcr_member->last_name = $row[1];
                $pcr_member->middle_name = '';
                $pcr_member->first_name = $row[2];
                $pcr_member->email = '';
                $pcr_member->prc_number = 'N/A';
                $pcr_member->is_trainee = 0;
                $pcr_member->address = 'N/A';
                $pcr_member->is_approved = 2;
                $pcr_member->save();
            }

            if($row[0] === "order") {
                new OrderService($row[2], $row[1], $row[3], $row[4]);
            }
        }
    }
}
