<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    public function attempt()
	{
		return $this->belongsTo(StudentExamAttempt::class, 'student_exam_attempt_id');
	}
}
