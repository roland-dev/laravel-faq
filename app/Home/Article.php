<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 定义关联的数据表
    protected $table = 'article';
    // 禁用时间字段
    public $timestamps = false;

    // 模型的关联操作，关联作者模型（一对一）
    public function author(){
    	return $this -> hasOne('App\Home\Author', 'id', 'author_id');
    }

    // 模型的关联操作，关联评论模型（一对多）
    public function comment(){
    	return $this -> hasMany('App\Home\Comment', 'article_id', 'id');
    }

    // 模型的关联操作，关联关键词（多对多）
    public function keyword(){
    	// 被关联模型的元素空间路径，多对多模型的关系表名，当前模型中的关系键，被关联模型的关系键
    	// 查询每个文章的全部关键词
        return $this -> belongsToMany('App\Home\Keyword', 'relation', 'article_id', 'key_id');
    }
}
