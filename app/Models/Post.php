<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    
    protected $fillable = [
        "id_category",
        "content", //description
        "createtime",
        "facebookUrl",
        "firstIncrease",
        "firstName",
        "firstPrice",
        "headImg", //avt_image
        "img",
        "important",
        "influence",
        "linkUrl",
        "lookNum",
        "messageid",
        "otherId",
        "status",
        "title",
        "type",
        "youtubeUrl",
        "id_user_create",
        "video",
        'id_category',
        'id_user_create',
    ];
    // protected $fillable = [
    //     'id_category',
    //     'id_user_create',
    //     'id_user_update',
    //     'status',
    //     'title',
    //     'des_preview',
    //     'description',
    //     'avt_image',
    //     // 'date_up_post',
    //     'video',
    //     'amount_read',
    // ];
    public function category()
    {
        return $this->hasOne(Category::class,'id', 'id_category');
    }

}
