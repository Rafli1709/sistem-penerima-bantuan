<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKriteria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_kriteria';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the kriteria associated with the SubKriteria.
     *
     * Defines a many-to-one relationship with the Kriteria model.
     * This function retrieves the Kriteria record that this SubKriteria belongs to.
     *
     * @return BelongsTo Relationship to the Kriteria model.
     */
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    /**
     * Get the penilaian associated with the SubKriteria.
     *
     * Defines a one-to-many relationship with the Penilaian model.
     * This function retrieves all Penilaian records that belong to a specific SubKriteria.
     *
     * @return HasMany Relationship to the Penilaian model.
     */
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
