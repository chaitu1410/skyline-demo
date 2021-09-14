<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

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
     * @return int
     */
    public function handle()
    {
        $input['name'] = $this->ask('Enter admin name >>>');
        $input['mobile'] = $this->ask('Enter admin mobile number >>>');
        $input['email'] = $this->ask('Enter admin email address >>>');
        $input['password'] = $this->secret('Enter admin password >>>');
        $input['password_confirmation'] = $this->secret('Conform password >>>');

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ], [
            'name.required' => 'Please enter your name',
            'name.string' => 'Please enter valid name',
            'name.max' => 'Name can have maximum 255 characters',
            'mobile.required' => 'Please enter mobile number',
            'mobile.digits' => 'Please enter valid mobile number',
            'mobile.numeric' => 'Please enter valid mobile number',
            'mobile.unique' => 'This mobile number is already taken',
            'email.required' => 'Please enter email address',
            'email.email' => 'Please enter valid email address',
            'email.string' => 'Please enter valid email address',
            'email.max' => 'Email can have maximum 255 characters',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Password and confirm password should be equal',
            'password_confirmation.required' => 'Please enter password confirmation',
        ]);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $key => $error) {
                $this->error(($key + 1) . ". " . $error);
            }
        } else {
            unset($input['password_confirmation']);
            $input['password'] = Hash::make($input['password']);
            $input['isAdmin'] = true;
            $user = User::create($input);
            $user->address()->create([]);
            $this->info('Admin was created successful!');
        }
    }
}
