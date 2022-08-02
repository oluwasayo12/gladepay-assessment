<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    const DEFAULT_ROLE = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'first_name',
        'last_name',
        'phone',
    ];


    public function setPasswordAttribute($value)
    {
        if (Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

}
