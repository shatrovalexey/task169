<?php

namespace App\Http\Controllers;

use App\Models\{Resources, Bookings};
use App\Http\Resources\{ResourcesResource, BookingResource};
use Illuminate\Http\Request;

class Api extends Controller
{
    /**
    * Получение списка всех ресурсов
    */
    public function getResources(Request $request)
    {
        return new ResourcesResource(Resources::get());
    }

    /**
    * Создание ресурса
    */
    public function addResource(Request $request)
    {
        $objh = new Resources();
        foreach (['name', 'type', 'description',] as $key) $objh->$key = $request->input($key);
        $objh->save();

        return new ResourcesResource($objh);
    }

    /**
    * Получение всех бронирований для ресурса
    *
    * @param int $id
    */
    public function getBookings(int $id)
    {
        return new BookingResource(Bookings::where('resource_id', $id)->get());
    }

    /**
    * Отмена бронирования
    *
    * @param int $id
    */
    public function delBooking(int $id)
    {
        return !!Bookings::find($id)::delete(),];
    }

    /**
    * Создание бронирования
    */
    public function addBooking(Request $request)
    {
        $objh = new Bookings();
        foreach (['resource_id', 'user_id', 'start_time', 'end_time',] as $key) $objh->$key = $request->input($key);
        $objh->save();

        return new BookingResource($objh);
    }
}
