<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyperUser extends \BaoPham\DynamoDb\DynamoDbModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $table = 'iam_users';
    protected $fillable = array('id', 'name', 'email');
}
