<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Admin;
use App\User;
class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {name} {fname} {lname} {email} {password} {confirm_password} {date_of_birth} ';

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
        if($this->argument('password') == $this->argument('confirm_password')){
            $user = new User;
            if(is_string($this->argument('name')) && is_string($this->argument('fname'))&&is_string($this->argument('lname')))
            {
                $user->name = $this->argument('name');
                if(filter_var($this->argument('email') ,FILTER_VALIDATE_EMAIL))
                {
                    $user->email = $this->argument('email');

                }else{
                    $this->error('Invalid Email !! ');
                    exit();
                }
                $user->password = bcrypt($this->argument('password'));
                $user->role = 'admin';
                $user->save();
                $admin = new Admin;
                $admin->fname = $this->argument('fname');
                $admin->lname = $this->argument('lname');

                $date_of_birth = date('Y-m-d',strtotime($this->argument('date_of_birth')));
                if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_of_birth )){
                    $admin->date_of_birth = $this->argument('date_of_birth') ;
                    $admin->user_id = $user->id;
                    $admin->save();
                }else{
                    $this->error('Invalid Date of Birth');
                    exit();
                }
            }else{
                $this->error('Invalid name');
                exit();
            }
        }else{
            $this->error("The password confirmation does n't match");
            exit();
        }
    }
}
