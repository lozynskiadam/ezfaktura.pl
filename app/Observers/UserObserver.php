<?php

namespace App\Observers;

use App\Dictionaries\InvoiceTypeDictionary;
use App\Helpers\GUSHelper;
use App\Models\Notification;
use App\Models\Signature;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if ($report = GUSHelper::find($user->nip)) {
            $user->name = $report->getName();
            $user->address = $report->getStreet() . ' ' . $report->getPropertyNumber() . '/' . $report->getApartmentNumber();
            $user->postcode = $report->getZipCode();
            $user->city = $report->getCity();
            $user->save();
        }

        $signature = new Signature();
        $signature->user_id = $user->id;
        $signature->name = 'default';
        $signature->syntax = 'FV/{year}/{month}/{counter}';
        $signature->description = 'default signature';
        $signature->mode = 'monthly';
        $signature->save();
        $signature->invoice_types()->sync([InvoiceTypeDictionary::BASIC]);

        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->title = __('translations.notifications.welcome.title', ['app' => env('APP_NAME')]);
        $notification->message = __('translations.notifications.welcome.message');
        $notification->date = date('Y-m-d H:i:s');
        $notification->icon = 'fa fa-hands-helping';
        $notification->class = 'primary';
        $notification->save();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
