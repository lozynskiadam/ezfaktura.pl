<?php

namespace App\Services;

use App\Models\Contractor;
use App\Models\User;

class ContractorService
{
    public function updateOrCreateContractor(User $user, $data) : Contractor
    {
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