<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hris_cloud_brand_menu;
use App\Models\Hris_cloud_brand_menu_addon;

class Hris_cloud_brand extends Model
{
    use HasFactory;

// public function hrisCloudBrandMenu() {
//     return $this->hasMany(Hris_cloud_brand_menu::class, 'brand_id');
// }
}
