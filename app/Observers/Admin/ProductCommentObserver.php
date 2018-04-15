<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 16:20
 */

namespace App\Observers\Admin;

use App\Models\ProductComment;

class ProductCommentObserver {

    public function created(ProductComment $productComment)
    {
        $grade = ProductComment::query()->where('product_id', $productComment->product_id)->avg('grade');
        $productComment->product->grade = sprintf("%.1f", $grade);
        $productComment->product->comment += 1;
        $productComment->product->save();
    }

    public function updated(ProductComment $productComment)
    {
        $grade = ProductComment::query()->where('product_id', $productComment->product_id)->avg('grade');
        $productComment->product->grade = sprintf("%.1f", $grade);
        $productComment->product->save();
    }

    public function deleted(ProductComment $productComment)
    {
        $grade = ProductComment::query()->where('product_id', $productComment->product_id)->avg('grade');
        $productComment->product->grade = sprintf("%.1f", $grade);
        $productComment->product->comment -= 1;
        $productComment->product->save();
    }

}