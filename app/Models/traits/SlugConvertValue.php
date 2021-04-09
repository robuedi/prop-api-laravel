<?php


namespace App\Models\traits;


use Illuminate\Support\Str;

trait SlugConvertValue
{
    public function setSlugAttribute($value) {
        $source_field = $this->slug_source_field;

        if (static::whereSlug($slug = Str::slug($value))->exists()) {

            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (static::whereSlug($slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }
}
