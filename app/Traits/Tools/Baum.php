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
     * 获取当前模型的父级节点id与名称，包括当前节点。
     * @return mixed
     */
    public function getPathItemAndSelf()
    {
        $item = $this->getAncestorsAndSelf();
        $path = $item->map(function ($item) {
            return $item->id;
        })->toArray();
        $pathName = $item->map(function ($item) {
            return $item->title;
        })->toArray();
        return [
            'path' => $path,
            'pathName' => $pathName
        ];
    }

    /**
     * 获取当前模型的父级节点，包括当前节点
     * @return mixed
     */
    public function getPathAndSelf()
    {
        return $this->getAncestorsAndSelf(['id'])->map(function ($item) {
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

    /**
     * 获取节点树
     * @param int $id
     * @param int $depth
     * @return array
     */
    public function getTree($id = 0, $depth = 0)
    {
        $data = [];
        $query = $this->query();
        if ($depth > 0) {
            $query = $query->where('depth', 0);
        }
        if ($id > 0) {
            $item = $this->findOrFail($id);
            $data = array_merge($data, $item->getPathItemAndSelf());
        }
        $data['tree'] = $query->get()->toHierarchy()->values();
        return $data;
    }

    /**
     * 获取当前分类的节点树
     * @param int $id
     * @return array
     */
    public function getClassifyTree($id = 0)
    {
        $data = [];
        $query = $this->query();
        if ($id > 0) {
            $item = $this->findOrFail($id);
            $data['path'] = $item->getPath();
            $data['children'] = $item->getChildrenAndSelf();
            $query = $query->whereNotIn('id', $data['children']);
        }
        $data['tree'] = $query->get()->toHierarchy()->values();
        return $data;
    }
}