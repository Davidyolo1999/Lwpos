<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable= ['name','image'];

    public function products(){
        return $this->hasMany(Product::class); // una categoria puede tener muchos productos
    }

    public function getImagenAttribute(){
        if($this->image !=null)
    return (file_exists('storage/categories/'. $this->image) ? $this->image : 'nimg.jpg');
    else
    return 'nimg.jpg';
    }

}
