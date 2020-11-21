<?php


namespace LoaiDev\Form\Traits;


use LoaiDev\Form\Entry;
use LoaiDev\Form\Form;

trait InteractsWithForms
{
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

}
