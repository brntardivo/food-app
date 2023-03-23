<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\BranchAddress;
use App\Models\BranchUser;
use Illuminate\Support\Facades\Hash;
use DB;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::beginTransaction();

        try{

            $role = Role::factory()->create([
                'name' => 'Admin'
            ]);

            $user = User::factory()->create([
                'name' => 'Bruno Tardivo',
                'email' => 'brn.tardivo@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
            ]);

            $branch = Branch::factory()
                ->has(BranchAddress::factory(), 'address')
                ->create();

            BranchUser::factory()
                ->for($role)
                ->for($user)
                ->for($branch)
                ->create();

            DB::commit();

        }catch(\Exception $e)
        {
            DB::rollback();

            throw $e;
        }

    }
}
