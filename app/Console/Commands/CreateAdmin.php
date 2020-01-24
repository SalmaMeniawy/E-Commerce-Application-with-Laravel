<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome in LaraStroe');
        $this->info('we need the basic info to create new admin in the following inputs');
        $name = $this->ask('admin name ?');
        $fname = $this->ask('first name ?');
        $lname = $this->ask('last name ? ');
        $email = $this->ask('admin Email ?');
        $password = $this->secret('enter password : ');
        $confirm_password = $this->secret('confirm password :');
        if($password != $confirm_password){
            $this->error("the password confirmation does n't match");
            $this->error('try again later!!');
            exit();
        }
    }
}
