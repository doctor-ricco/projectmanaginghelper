<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'eid',
        'description',
        'start_date',
        'end_date',
        'status',
    ];



    public function tasks()
    {
        return $this->hasMany(Task::class);
    }



    public function hasDueTodayTasks()
    {
        return $this->tasks->where('status', '!=', 'completed')
            ->where('due_date', Carbon::today()->toDateString())
            ->count() > 0;
    }

    public function hasDueTomorrowTasks()
    {
        return $this->tasks->where('status', '!=', 'completed')
            ->where('due_date', Carbon::tomorrow()->toDateString())
            ->count() > 0;
    }
}
