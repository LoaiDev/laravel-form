<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Question
 * @package LoaiDev\Form
 *
 * @property Section $page
 * @property Collection $options
 * @property Collection $answers
 */
class Question extends Model
{
    use HasFactory;

    protected $casts = [
        'rules' => 'array'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'page_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
