<?php

namespace App\Models;

use App\Traits\Tools\Resource;
use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
{
    use Resource;
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
        $this->fillable = (new Table())->getField('News')->map(function ($item) {
            return $item->name;
        })->toArray();
    }
}
