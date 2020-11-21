<?php


namespace LoaiDev\Form;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

/**
 * Class Model
 * @package LoaiDev\Form
 *
 * @method static static create(mixed[] $attributes)
 * @method static \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Model extends BaseModel
{

    protected $guarded = [];

    /**
     * set table when creating new instance
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (!isset($this->table)) {
            $this->setTable(config("form.database.tables.". static::getStaticConfigName()));
        }
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            //automatically generate public id
            $model->{$model->getPublicKeyName()} = $model->generatePublicKey();
        });
    }

    /**
     * Get Public key field name
     *
     * @return string
     */
    public function getPublicKeyName()
    {
        return 'public_id';
    }

    /**
     * Get public id.
     *
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getAttribute($this->getPublicKeyName());
    }

    /**
     * generate a unique public id.
     *
     * @return string
     */
    protected function generatePublicKey()
    {
        $id =  Str::random();
        while ($this->newQuery()->where($this->getPublicKeyName(), $id)->exists()) {
            $id =  Str::random();
        }
        return $id;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getPublicKeyName();
    }

    /**
     * returns the model name used in config.
     *
     * @return string
     */
    protected static function getStaticConfigName()
    {
        return Str::snake(Str::pluralStudly(class_basename(static::class)));
    }

}
