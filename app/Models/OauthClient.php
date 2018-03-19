<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $table='oauth_clients';
    protected $fillable = ['title','body','user_id'];
}
