<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masyarakat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'masyarakat';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the penilaian associated with the Masyarakat.
     *
     * Defines a one-to-many relationship with the Penilaian model.
     * This function retrieves all Penilaian records that belong to a specific Masyarakat.
     *
     * @return HasMany Relationship to the Penilaian model.
     */
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
