<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyperCategory extends \BaoPham\DynamoDb\DynamoDbModel
{
    public function category()
    {
        return $this->belongsTo('App\HyperCategory');
    }

    protected $table = 'iam_categories';


    protected $fillable = ["createdAt", "dash", "hls", "id", "imageLogo", "images", "imageSmall", "mp4", "name", "parentId", "projectId", "slug", "tracks", "type" ];


    protected $hidden = [
        
    ];
}


  
