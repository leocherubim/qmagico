<?php

use Illuminate\Database\Seeder;
use QMagico\Entities\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin group
        Group::create(['name'=>'Administrador']);
        // create studant group
        Group::create(['name'=>'Estudante']);
    }
}
