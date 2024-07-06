<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static inRandomOrder()
 */
class Quote extends Model
{

    protected $fillable = [
        'quote',
        'vn_id',
    ];
    public $timestamps = false;
    protected $appends = [
        "vn_url"
    ];

    protected function vnUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => "https://vndb.org/v" . $this->vn_id,
        );
    }
}
