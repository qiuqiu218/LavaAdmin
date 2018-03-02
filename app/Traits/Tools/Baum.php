<?php
/**
 * Created by PhpStorm.
 * User: wanxin
 * Date: 2018/2/26
 * Time: 下午9:54
 */

namespace App\Traits\Tools;

trait Baum {
    /**
     * 获取当前模型的父级节点，不包括当前节点。
     * return format [1, 2, 3]
     * @return \Illuminate\Support\Collection|static
     */
    public function getPath()
    {
        return $this->getAncestors(['id'])->map(function ($item) {
            return $item->id;
        });
    }

    /**
     * 获取当前模型的子节点，包括本级。
     * return format [1, 2, 3]
     * @return \Illuminate\Support\Collection|static
     */
    public function getChildrenAndSelf()
    {
        return $this->getDescendantsAndSelf(['id'])->map(function ($item) {
            return $item->id;
        });
    }
}