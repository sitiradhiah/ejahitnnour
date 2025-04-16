<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'categories'; // Make sure this matches your table name

    // Define which fields are mass assignable (prevent mass-assignment vulnerabilities)
    protected $fillable = ['name'];

    // Optionally, you can define any validation rules here if needed
    // public static $rules = [
    //     'name' => 'required|string|max:255',
    // ];
}
