<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name","price","sales",'offer',"quantity","image","image2","category_id"];

    /**one to many **/
    public function category(){
        return $this->belongsTo(Category::class);
    }



    public function orders(){
        return $this->belongsToMany(Order::class,'order_product');
    }

    /** make mutation */

    public function format_price($value){
        return number_format($value,2) . ' EGP';
    }





}
