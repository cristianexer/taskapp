<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $table = 'tasks_list';
    protected $fillable = ['title','description','user_id'];


}
