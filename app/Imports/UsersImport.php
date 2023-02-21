<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'last_name' => $row[0],
            'first_name' => $row[1],
            'password' => Hash::make('password123'),
            'email' => $row[2],
            'tag_id' => $row[3],
            'userable_type' => 'App\Models\User',
            'userable_id' => 0,
            'role' => 'attendee'
        ]);
    }
}
