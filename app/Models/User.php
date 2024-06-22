<?php


namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'name',
        'birth_date',
        'address',
        'zip_code',
        'city',
        'phone',
        'email',
        'password',
        'activity_type',
        'about',
        'is_admin',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    // Dans le modèle User
    public function updateProfilePhoto($photoFile)
    {
        $path = $photoFile->store('profile-photos', 'public');
        $this->profile_photo_path = $path;
        $this->save();
    }

    //Followers
    public function followers()
    {
        return $this->hasMany(Follow::class, 'user_id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    //Private message 
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    //exped id
    public function sender()
{
    return $this->belongsTo(User::class, 'from_user_id');
}

}

///////////////////////////////////////////////////////////////

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable
// {
//     use HasApiTokens;
//     use HasFactory;
//     use HasProfilePhoto;
//     use Notifiable;
//     use TwoFactorAuthenticatable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'first_name',
//         'name',
//         'birth_date',
//         'email',
//         'address',
//         'zip_code',
//         'city',
//         'phone',
//         'activity_type',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//         'two_factor_recovery_codes',
//         'two_factor_secret',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];

//     /**
//      * The accessors to append to the model's array form.
//      *
//      * @var array<int, string>
//      */
//     protected $appends = [
//         'profile_photo_url',
//     ];
// }
