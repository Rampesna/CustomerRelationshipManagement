<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Listeners\LoginSuccessful;
use App\Listeners\SendNewActivityEmailListener;
use App\Listeners\SendNewCustomerEmailListener;
use App\Listeners\SendNewManagerEmailListener;
use App\Listeners\SendNewOfferEmailListener;
use App\Listeners\SendNewOpportunityEmailListener;
use App\Listeners\SendNewPriceListEmailListener;
use App\Listeners\SendNewSampleEmailListener;
use App\Listeners\SendNewStockEmailListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LoginSuccessful::class
        ],
        SendEmailEvent::class => [
            SendNewActivityEmailListener::class,
            SendNewCustomerEmailListener::class,
            SendNewManagerEmailListener::class,
            SendNewOfferEmailListener::class,
            SendNewOpportunityEmailListener::class,
            SendNewPriceListEmailListener::class,
            SendNewSampleEmailListener::class,
            SendNewStockEmailListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
