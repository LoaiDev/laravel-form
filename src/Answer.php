<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Answer
 * @package LoaiDev\Form
 *
 * @property Entry $entry
 * @property Question $question
 */
class Answer extends Model
{
    use HasFactory;

    public function entry()
    {
        $this->belongsTo(Entry::class);
    }

    public function question()
    {
        $this->belongsTo(Question::class);
    }
}
