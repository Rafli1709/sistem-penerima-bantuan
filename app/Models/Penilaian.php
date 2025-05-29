<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the masyarakat associated with the Penilaian.
     *
     * Defines a many-to-one relationship with the Masyarakat model.
     * This function retrieves the Masyarakat record that this Penilaian belongs to.
     *
     * @return BelongsTo Relationship to the Masyarakat model.
     */
    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class);
    }

    /**
     * Get the kriteria associated with the Penilaian.
     *
     * Defines a many-to-one relationship with the Kriteria model.
     * This function retrieves the Kriteria record that this Penilaian belongs to.
     *
     * @return BelongsTo Relationship to the Kriteria model.
     */
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    /**
     * Get the subKriteria associated with the Penilaian.
     *
     * Defines a many-to-one relationship with the SubKriteria model.
     * This function retrieves the SubKriteria record that this Penilaian belongs to.
     *
     * @return BelongsTo Relationship to the SubKriteria model.
     */
    public function subKriteria(): BelongsTo
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
