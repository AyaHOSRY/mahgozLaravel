<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Review;
use App\Models\Size;
use App\Models\Favorite;
use App\Models\Image;


class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'description', 'count', 'rate', 'discount', 'size_id', 'category_id', 'area' ,'lat', 'long'
    ];
    //
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //
    public function sizes()
    {
      return $this->belongsToMany(Size::class, 'service_size', 'service_id' , 'size_id');
    }
    
    //
    public function images()
    {
      return $this->hasMany(Image::class);
    }  
    //
    public function reviews()
    {
      return $this->hasMany(Review::class);
    }
    //
    
    public function favorites()
    {
      return $this->hasMany(Favorite::class);
    }
    public function orders()
    {
      return $this->hasMany(Order::class);
    }
    

}
