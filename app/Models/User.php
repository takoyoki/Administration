<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

//     protected static function boot()
// {
//     parent::boot();

//     static::created(function ($user) {
//         \Log::info('User created: ' . $user->id); // ユーザーが作成されたことをログに記録

//         if ($user->role === 1) {
//             try {
//                 // 作業員の場合、Worker モデルを作成し、関連付ける
//                 $worker = Worker::create([
//                     'name' => $user->name,
//                     'email' => $user->email,
//                 ]);

//                 // 作業員の場合、worker_id を設定する
//                 $user->worker()->associate($worker)->save();
//                 \Log::info('Worker created: ' . $worker->id); // 作業員が作成されたことをログに記録
//                 \Log::info('User worker_id: ' . $user->worker_id);
//             } catch (\Exception $e) {
//                 \Log::error('Error creating worker: ' . $e->getMessage()); // エラーをログに記録
//             }
//         }
//     });
// }







    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'worker_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}