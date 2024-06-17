<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder find($id, $columns = ['*'])
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class VnUrl extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "id",
        "insert_at"
    ];

    protected $appends = [
        "insert_at_str"
    ];

    protected function insertAtStr(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->insert_at === null) {
                    $this->insert_at = time();
                }
                $date = date("d m Y, H:i:s T", $this->insert_at);

                $bulanMapping = [
                    "01" => "Januari",
                    "02" => "Februari",
                    "03" => "Maret",
                    "04" => "April",
                    "05" => "Mei",
                    "06" => "Juni",
                    "07" => "Juli",
                    "08" => "Agustus",
                    "09" => "September",
                    "10" => "Oktober",
                    "11" => "November",
                    "12" => "Desember",
                ];
                $explodeDate = explode(" ", $date);
                return $explodeDate[0] .
                    " " .
                    $bulanMapping[$explodeDate[1]] .
                    " " .
                    $explodeDate[2] .
                    " " .
                    $explodeDate[3] .
                    " " .
                    $explodeDate[4];
            }
        );
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class, "id", "vn_id");
    }

}
