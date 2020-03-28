<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Admin;
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
    protected $description = 'Command create:admin to create new Admin in your system we need to take basic data (name , fname , lname , email , password)';

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
        $validator = Validator::make([
            'name'=>$name,
            'fname'=>$fname,
            'lname'=>$lname,
            'password' => $password,
            'email'=>$email,
        ],[
            'name' => 'required|alpha',
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'email' => 'required|unique:users|email',
            'password'=>'required',
        ]);
        if($validator->fails()){
            $this->comment("Admin have n't been created see error messages below ");
            foreach($validator->errors()->all() as $error){
                $this->error($error);
            }
        }else{
            $user = User::create([
                'name'=>$name,
                'email'=>$email,
                'role'=>'admin',
                'password'=>bcrypt($password),
            ]);
            $admin = Admin::create([
                'fname' => $fname,
                'lname' => $lname ,
                'user_id' => $user->id,
            ]);
            if(isset($user) && isset($admin)){
                $this->info('Admin created successfully !');
            }

        }
    }
}
