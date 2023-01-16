<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function checkName($name)
    {
        return Group::where('name', $name)->first();
    }

    public function index($data)
    {
        $groups = Group::where('name', 'like', '%' . $data->search . '%')->get();
        $pagination = false;

        if (!$data->search || !$groups->first()) {
            $groups = Group::paginate(25);
            $pagination = true;
        }

        return ['groups' => $groups, 'pagination' => $pagination]; 
    }

    public function store($data)
    {
        $group = Group::create([
            'name' => $data->name,
        ]);

        $group->users()->attach(array_map('intval', $data->users));
    }

    public function update($group, $data)
    {
        if ($data->name !== $group->name) {
            $nameAlreadyUsed = Group::where('name', $data->name)->first();
            
            if ($nameAlreadyUsed) return back()->with('groupUpdateFailure', 'Ce nom est déjà utilisé');
        }

        $group->update([
            'name' => $data->name,
        ]);

        $group->users()->sync(array_map('intval', $data->users));
    }

    public function destroy($group)
    {
        $group->users()->detach($group->users()->pluck('id')->toArray());
        $group->delete();
    }
}