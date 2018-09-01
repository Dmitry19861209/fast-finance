<?php

namespace App\Helpers;


trait ModelTrait
{
    /**
     * Change count and return Model with new count OR false
     *
     * @param $query
     * @param bool $increment
     * @return ModelTrait|bool
     */
    public function scopeUpdateCount($query, $increment=false)
    {
        if($increment) {
            $this->count++;
            $this->save();

            return $this;
        } else {
            if ($this->count === 0)
                return false;

            $this->count--;
            $this->save();

            return $this;
        }
    }
}