<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    public function __construct()
    {
        parent::__construct();
        $this->initFillable();
    }

    public function initFillable()
    {
        $table = $this->getTable();
        dd($table);
    }
}
