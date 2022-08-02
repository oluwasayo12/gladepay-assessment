<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Companies extends Model
{
    use HasFactory, SoftDeletes;

    const DEFAULT_FILE_FORMAT= ['pdf','jpg','png'];

    const DEFAULT_ROLE = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'website'
    ];

    public function employees()
    {
        return $this->hasMany(Employees::class, 'company_id');
    }
}
