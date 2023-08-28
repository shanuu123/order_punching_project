<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hris_cloud_brand_menu extends Model
{
    use HasFactory;
    public $table="hris_cloud_brand_menu";
    // public function hris_cloud_brand_menu_addons() {
    //     return $this->belongsTo(Hris_cloud_brand_menu_addon::class,'menu_id');
    // }
    // public function hrisCloudBrand() {
    //     return $this->belongsTo(Hris_cloud_brand::class, 'brand_id');
    // }

    // public function hrisCloudBrandMenuAddon() {
    //     return $this->hasMany(Hris_cloud_brand_menu_addon::class, 'menu_id');
    // }
}
