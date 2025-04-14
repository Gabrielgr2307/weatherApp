<?php

namespace Modules\History\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class SearchHistory extends Model
{
    use HasFactory;
    protected $fillable = ['city'];


    protected static function newFactory()
    {
        return \Modules\History\Database\factories\SearchHistoryFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
