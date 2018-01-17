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
        $this->fillable = (new Table())->getField($this->getModel())->map(function ($item) {
            return $item->name;
        })->toArray();
    }

    public function getTableCol()
    {
        return (new Table())
                    ->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->belong === 1 && $item->is_show;
                    });
    }

    public function getTableDetailField()
    {
        return (new Table())
                    ->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->is_import === 1;
                    });
    }

    public function getTableData()
    {
        $data = self::query()->select($this->getTableListField())->get();

    }

    public function getTableListField()
    {
        return $this->getTableCol()->map(function ($item) {
            return $item->name;
        })->toArray();
    }
}
