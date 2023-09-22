<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $primaryKey = 'ResidentID'; // Specify the primary key field name
    protected $table = 'resident';
    protected $fillable = [
        'Name',
        'ResidentNum',
        'Gender',
        'Race',
        'DOA',
        'DOB',
        'Photo',
        'Language',
        'StaffID',
        'Status',
        'ProfilePDF',
        'LastUpdateDT',
    ];

    // I have disabled timestamps for the meantime because the 'Resident' table does not have 'created_at' and 'updated_at' columns.
    public $timestamps = false;
}
