<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kriteria';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The boot method for the Kriteria model.
     *
     * This function is triggered when a new Kriteria instance is created.
     * It auto-generates a 'kode' value based on the highest existing value.
     * The 'kode' is formed as 'C' followed by an incremented number.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($item) {
            $highestCode = static::selectRaw('MAX(CAST(SUBSTRING(kode, 2) AS SIGNED)) as max_code')->value('max_code');

            if ($highestCode) {
                $numericPart = intval($highestCode);
                $item->kode = 'C' . ($numericPart + 1);
            } else {
                $item->kode = 'C1';
            }
        });
    }

    /**
     * Get the subKriteria associated with the Kriteria.
     *
     * Defines a one-to-many relationship with the SubKriteria model.
     * This function retrieves all SubKriteria records that belong to a specific Kriteria.
     *
     * @return HasMany Relationship to the SubKriteria model.
     */
    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class);
    }

    /**
     * Get the penilaian associated with the Kriteria.
     *
     * Defines a one-to-many relationship with the Penilaian model.
     * This function retrieves all Penilaian records related to the specific Kriteria.
     *
     * @return HasMany Relationship to the Penilaian model.
     */
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
