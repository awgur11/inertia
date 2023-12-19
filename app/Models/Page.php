<?php

namespace App\Models;

use App\Helpers\ImagesProperFormatHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    
    protected $table = 'pages';

    protected $fillable = ['type', 'alt_title', 'preview', 'parent_id', 'category_id', 'position', 'public', 'user_id'];

    protected $appends = ['origin_preview', 'fhd_preview', 'one_preview', 'two_preview', 'tree_preview', 'four_preview', 'five_preview', 'six_preview', 'mini_preview'];


    public static function boot()
    {
        parent::boot();

        Page::deleting(function($page){
            foreach($page->languages as $language) {
                $language->delete();
            }
        });

        Page::created(function ($page) {
            $page->position = $page->id;
            $page->save();
        });
    }

    protected $no_photo = '/storage/images/no-photo.jpg';

    public function fvalue()
    {
        return $this->belongsTo('App\Models\Fvalue');
    }

    public function languages()
    {
        return $this->hasMany('App\Models\Page_languages');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Page_languages')->where('language', \App::getLocale())->withDefault([
                'title' => '',
                'menu' => '',
                'content' => '',
                'description' => '',
                'tag_title' => ''
            ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOriginPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);
        
        return asset('/storage/images'.$this->preview);
    }

    public function getFhdPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);
        
        return asset(str_replace('img-', 'img-fhd-', $this->preview));
    }

    public function getOnePreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-one-', $this->preview));
    }

    public function getTwoPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-two-', $this->preview));
    }

    public function getTreePreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-tree-', $this->preview));
    }

    public function getFourPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-four-', $this->preview));
    }

    public function getFivePreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-five-', $this->preview));
    }

    public function getSixPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-six-', $this->preview));
    }

    public function getMiniPreviewAttribute()
    {
        if($this->preview_path == '')
            return asset($this->no_photo);

        return asset(str_replace('img-', 'img-mini-', $this->preview));
    }


}
