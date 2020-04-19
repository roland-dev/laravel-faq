<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // 关联数据库，如果数据库是复数形式就不需要写这行也可以
    protected $table = "faq_question";
    public $timestamps = false;
}
