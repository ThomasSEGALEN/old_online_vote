<?php

namespace App\Services;

use App\Models\Session;

class SessionService
{
    public function checkTitle($title)
    {
        return Session::where('title', $title)->first();
    }

    public function store($data)
    {
        $session = Session::create([
            'title' => $data->title,
            'description' => $data->description,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
        ]);

        $session->users()->attach(array_map('intval', $data->users));
    }

    public function update($session, $data)
    {
        $session->update([
            'title' => $data->title,
            'description' => $data->description,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
        ]);

        $session->users()->sync(array_map('intval', $data->users));
    }

    public function destroy($session)
    {
        $session->users()->detach($session->users()->pluck('id')->toArray());
        $session->delete();
    }
}