<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Entry
 * @package LoaiDev\Form
 *
 * @property Form $form
 */
class Entry extends Model
{
    use HasFactory;

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function participant()
    {
        return $this->belongsTo(config('form.model'));
    }
}
