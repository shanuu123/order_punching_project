<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hris_cloud_order extends Model
{
    use HasFactory;
    public $timestamps = TRUE;
    const CREATED_AT='order_date';
    const UPDATED_AT='order_time';
}
