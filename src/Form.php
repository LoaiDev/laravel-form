<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;


/**
 * Class Form
 * @package LoaiDev\Form
 *
 * @property Collection|Entry[] $entries
 * @property Collection|Question[] $questions
 * @property Collection|Section[] $sections
 * @property array $rules
 *
 */
class Form extends Model
{
    use HasFactory;

    protected $casts = [
        'settings' => 'array',
    ];

    public function getRulesAttribute()
    {
        return $this->questions()->pluck('rules', 'questions.'.$this->getPublicKeyName());
    }

    public function getValidator($data)
    {
        Validator::make($data, $this->rules);
    }

    public function validate($data, ValidatorContract $validator = null)
    {
        $validator = $validator ?? $this->getValidator($data);
        $validator->validate();
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Section::class);
    }
}
