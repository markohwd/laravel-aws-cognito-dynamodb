<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyperOrganization extends \BaoPham\DynamoDb\DynamoDbModel
{

    public function organization()
    {
        return $this->belongsTo('App\HyperOrganization');
    }

    protected $table = 'iam_organizations';


    protected $fillable = ['createdAt', 'logoUrl', 'name', 'plan', 'slug', 'type', 'email', 'location', 'photoUrl', 'bucket', 'categoryId' ];


    protected $hidden = [
        'id',
    ];
}
