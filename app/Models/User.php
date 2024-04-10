<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $email
 * @property string|null $confirm_token
 * @property \DateTime|null $email_verified_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_token'
    ];

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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function verify(): void
    {
      if (null !== $this->email_verified_at) {
          throw new \DomainException('You are already verified!');
      }

      $this->email_verified_at = new \DateTime();
      $this->confirm_token = null;
    }

    public function isConformed(): bool
    {
      return !is_null($this->email_verified_at);
    }


    public function getEmail(): string
    {
        return $this->email;
    }
}
