<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model {
    protected $casts = [
        'start_time' => 'datetime'
        , 'end_time' => 'datetime'
        ,
    ];

    public static function saving($model) {
        parent::saving($model);

        $validator = Validator::make($model->attributes, [
            'start_time' => 'required|date'
            , 'end_time' => 'required|date|after:start_time'
            ,
        ]);

        if ($validator->fails()) throw new \Illuminate\Validation\ValidationException($validator);
    }

    public static function boot()
    {
        parent::boot();
        static::clean();
    }

    /**
    * Удаление устаревших записей
    */
    public static function clean()
    {
        return static::whereRaw('
(? NOT BETWEEN start_time AND end_time)
    AND (start_time < ?)
        ', [now(), now(),])->delete();
    }
}
