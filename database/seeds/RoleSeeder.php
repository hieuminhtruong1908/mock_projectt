<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert(
            //1
            [
            ['user_id' => 5,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 6,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 7,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 8,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 9,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 10,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 11,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 12,'group_id' =>1,'level' => 1,'status' => 2 ],
            ['user_id' => 13,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 14,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 15,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 16,'group_id' =>1,'level' => 1,'status' => 1 ],
            ['user_id' => 17,'group_id' =>1,'level' => 1,'status' => 2 ],
            //2
            ['user_id' => 1,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 3,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 6,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 7,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 8,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 9,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 10,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 11,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 18,'group_id' =>2,'level' => 1,'status' => 2 ],
            ['user_id' => 13,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 14,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 15,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 16,'group_id' =>2,'level' => 1,'status' => 1 ],
            ['user_id' => 17,'group_id' =>2,'level' => 1,'status' => 2 ],

            //3
            ['user_id' => 1,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 3,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 4,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 5,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 6,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 7,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 8,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 9,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 10,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 11,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 12,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 13,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 14,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 15,'group_id' =>3,'level' => 1,'status' => 1 ],
            ['user_id' => 16,'group_id' =>3,'level' => 1,'status' => 2 ],
            ['user_id' => 18,'group_id' =>3,'level' => 2,'status' => 1 ]]

        );
    }
}
