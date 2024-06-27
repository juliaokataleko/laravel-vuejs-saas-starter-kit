<?php

namespace App\Models\Business;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Business\Traits\BusinessTrait;
use App\Notifications\MyCustomWelcomeNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Model
{
    use SoftDeletes, BusinessTrait;
    protected $guarded = [];

    protected $table = 'users';
}
