<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable {
    use SoftDeletes, Notifiable, LaravelVueDatatableTrait;
    protected $keyType = 'string';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dataTableColumns = [
        'id' => ['searchable' => false],
        'name' => ['searchable' => true, 'order_term' => 'orderable'],
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string', 'email_verified_at' => 'datetime',
    ];
    public static function boot() {
        parent::boot();
        self::creating(
            function ($model) {
                $model->id = (string) Uuid::generate(4);
            }
        );
    }

}
