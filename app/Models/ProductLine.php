<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    // 关联数据库，如果数据库是复数形式就不需要写这行也可以
    protected $table = 'faq_product_line';
    public $timestamps = false;

    // product_line 对应 category（一对多）
    public function category(){
        // 被关联模型的元素空间路径，多对多模型的关系表名，当前模型中的关系键，被关联模型的关系键
    	// 查询每个文章的全部关键词
        return $this -> belongsToMany('App\Models\Category', 'faq_productline_to_category', 'product_line_id', 'category_id');
    }
}
