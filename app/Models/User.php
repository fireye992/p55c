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
use Illuminate\Support\Str;
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
        'social_links',
        'last_activity',

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

    // ajouter mais pour le conversation
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if (empty($user->slug)) {
                $slug = Str::slug($user->name);
                $originalSlug = $slug;
                $counter = 1;

                // Ensure the slug is unique
                while (User::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $user->slug = $slug;
            }
        });
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    public function getSocialLinksAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function setSocialLinksAttribute($value)
    {
        $this->attributes['social_links'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function updateProfilePhoto($photoFile)
    {
        $path = $photoFile->store('profile-photos', 'public');
        $this->profile_photo_path = $path;
        $this->save();
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'user_id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function isOnline()
    {
        return $this->last_activity && Carbon::parse($this->last_activity)->gt(Carbon::now()->subMinutes(5));
    }


    public function updateActivity()
    {
        $this->last_activity = Carbon::now();
        $this->save();
    }
}