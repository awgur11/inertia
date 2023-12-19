<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page_languages extends Model
{
    use HasFactory;
    
    protected $table = 'pages_languages';

    public $timestamps = false;
    
    protected $fillable = ['menu', 'title', 'content', 'language', 'page_id', 'tag_title', 'description'];
 
    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }

}
