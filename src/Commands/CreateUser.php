<?php

namespace TerminalUser\Commands;

use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:user-add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is the user\'s name?');
        $email = $this->ask('What is the email?');
        $password = $this->secret('What password do you want to use?');

        $this->info('Making new user...');
        try {
            $user_class = $this->getUserClass();

            $user = new $user_class([
                'name'     => $name,
                'email'    => $email,
                'username'    => $email,
                'password' => bcrypt($password),
            ]);

            $user->save();

            $this->info('You\'ve got yourself a new user!');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
    }

    protected function getUserClass(): string
    {
        return '\\App\\User';
    }
}
