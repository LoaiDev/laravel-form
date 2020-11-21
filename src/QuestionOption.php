<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionOption
 * @package LoaiDev\Form
 *
 * @property Question $question
 */
class QuestionOption extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
