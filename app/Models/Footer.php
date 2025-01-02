<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function pages()
	{
		return  $this->hasMany(Page::class);
	}
}
