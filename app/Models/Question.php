<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // 关联数据库，如果数据库是复数形式就不需要写这行也可以
    protected $table = "faq_question";
    public $timestamps = false;

    // 搜索问题并进行分页
    publick function searchQuestion($conditions, $pageSize = -1) {
    	$model = self::orderBy('id', 'desc');
        foreach ($cond as $k => $v) {
            // 相同分类搜索使用in_array来判断的
            // if (in_array($k, ['category_code', 'sub_category_code', 'show'])) {
            //     $model = $model->where($k, '=', $v);
            // }
            if ($k == 'questions') {
                $model = $model->where($k, 'like', "%$v%");
            }

            if ($k == 'product_line') {
                $model = $model->where($k, "%$v%");
            }
        }

        if ($pageSize != -1) {
            $model = $model->take($pageSize);
        }

        $questionList = $model->orderBy('id', 'desc')->get();
        return empty($questionList) ? [] : $questionList->toArray();
    }
}
