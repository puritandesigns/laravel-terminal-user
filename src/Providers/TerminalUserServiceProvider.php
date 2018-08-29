<?php

namespace TerminalUser\Providers;

use TerminalUser\Commands\CreateUser;
use Illuminate\Support\ServiceProvider;

class TerminalUserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([CreateUser::class]);
    }
}
