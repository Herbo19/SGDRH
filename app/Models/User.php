<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

   public $director="/img/";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }

    function tipos(){
        return $this->belongsTo(Tipos::class,'role');
    }

    function funcionarios(){
        return $this->belongsTo(Funcionario::class,'idFuncionario');
    }


    public function userHasRole($role_titulo){
        foreach($this->roles as $titulo){
            if (Str::lower($role_titulo) == Str::lower($titulo)) {
                return true;
            }
        }
        return false;
    }


    function getAvatarAttribute($value){
        if ($value == "/img") {
            $df = '/img';
            $trimmed = str_replace($df, '', $value) ;
            return $this->director.$trimmed;
            if ($trimmed == "/img") {
                $dfa = '/img';
                $trim = str_replace($dfa, '', $trimmed) ;
                return $this->director.$trim;
            }
        }
        return $this->director.$value;
    }
}
