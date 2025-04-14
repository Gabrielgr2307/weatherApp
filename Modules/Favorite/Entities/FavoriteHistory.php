<?php

namespace Modules\Favorite\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class FavoriteHistory extends Model
{
    use HasFactory;

    protected $fillable = ['city'];

    protected static function newFactory()
    {
        // return \Modules\Favorite\Database\factories\FavoriteHistoryFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
