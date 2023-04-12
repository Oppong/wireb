<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'amount', 'status', 'dated'
    ];

    protected $casts = [
        'dated' => 'date',
    ];


    public function getStatusColorAttributes(){

        return [

            'processing' => 'indigo',
            'success' => 'green',
            'failed' => 'red',
        ][$this->status] ?? 'gray';
    }

    public function getDatedForHumansAttribute(){
        return $this->dated->format('M, d Y');
     }

     const STATUSES = [
        'success' =>  'Success',
        'processing' =>  'Processing',
        'failed' =>  'Failed',
     ];
}
