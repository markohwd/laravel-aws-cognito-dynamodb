<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyperOrganizationUser extends \BaoPham\DynamoDb\DynamoDbModel
{
    public function organizationuser()
    {
        return $this->belongsTo('App\HyperOrganizationUser');
    }

    protected $table = 'iam_organizations_users';

    protected $fillable = ['userId', 'organizationId', 'createdAt', 'role' ];

    protected $hidden = [
    ];
}
