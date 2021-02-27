<?php

namespace App\Services;

use App\Models\Contractor;
use App\Models\User;

class ContractorService
{
    public function updateOrCreateContractor($user_id, $data) : Contractor
    {
        $user = User::findOrFail($user_id);
        if(isset($data['id'])) {
            $contractor = $user->contractors()->findOrFail($data['id']);
        }
        else {
            $contractor = $user->contractors()->where('nip', $data['nip'])->first() ?? new Contractor();
        }
        $contractor->fill($data);
        $contractor->user_id = $user->id;
        $contractor->save();

        return $contractor;
    }
}