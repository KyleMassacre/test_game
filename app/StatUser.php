<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StatUser extends Pivot
{
    protected $fillable = ["value", "max_value"];
}
