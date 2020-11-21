<?php

namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Section
 * @package LoaiDev\Form
 *
 * @property Form $form
 * @property Collection|Question[] $questions
 * @property array $rules
 */
class Section extends Model
{
    use HasFactory;

    protected static function boot(): void
    {
        parent::boot();

        self::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy(' order');
        });
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getRulesAttribute()
    {
        return $this->questions->flatmap(function ($question) {
            return [$question->getPublicId() => $question->rules];
        });
    }
}
