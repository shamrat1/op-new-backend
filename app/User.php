<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use PhpParser\Builder\Class_;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'country',
        'mobile',
        'sponser_email',
        'club_id',
        'banned_until',
        'is_allowed_transaction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'banned_until'
    ];

    protected $dates = [
      'banned_until'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function club()
    {
      return $this->belongsTo(Club::class);
    }

    public function ownClub()
    {
      return $this->hasOne(Club::class,'user_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimeStamps();
    }

    public function credit(){
      return $this->hasOne(Credit::class);
    }

    public function placedBets()
    {
      return $this->hasMany(PlacedBet::class)->orderBy('created_at','desc');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function authorizeRoles($roles){
      if ($this->hasAnyRole($roles)) {
        return true;
        }
        abort(401, 'This action is unauthorized.');
    }
    public function hasAnyRole($roles)
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
                }
            }
        } else {
        if ($this->hasRole($roles)) {
          return true;
            }
        }
        return false;
    }
    public function hasRole($role){
      if ($this->roles()->where("name", $role)->first()) {
        return true;
        }
        return false;
    }
}
