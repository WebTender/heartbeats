<?php

namespace App\Models;

use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    use HasFactory, UUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'max_minutes',
        'last_pinged_at'
    ];

    protected $casts = [
        'last_pinged_at' => 'datetime'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        return Carbon::now()->diffInSeconds($this->last_pinged_at) / 60 < $this->max_minutes ? 'online' : 'missing in action';
    }

    public function isOnline()
    {
        return $this->status === 'online';
    }

    public function getUrlAttribute()
    {
        return url('/heartbeat/' . $this->id);
    }

    public function getStatusUrlAttribute()
    {
        return url('/heartbeat-status/' . $this->id);
    }
}
