<?php

use \Casa\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// vendor\bin\phpunit
class UserTest extends TestCase
{
    //Rollback na base de dados.
    use DatabaseTransactions;

    public function testCreateUser()
    {
        $user = new Usuario([
            'name'       => 'Admin User',
            'email'      => 'admin@admin.com',
            'cpf'        => '023.129.170-17',
            'cargo'      => 'adm',
            'created_at' => date('Y-m-d'),
        ]);

        $user->save();

        $this->seeInDatabase('users', ['name' => 'Admin User']);
    }

    public function testUpdateUser()
    {
        $user = Usuario::first();

        $user->update([
            'name'       => 'Admin User',
            'email'      => 'admin@admin.com',
            'cpf'        => '023.129.170-17',
            'cargo'      => 'adm',
            'created_at' => date('Y-m-d'),
        ]);
        
        $this->seeInDatabase('users', ['name' => 'Admin User']);
    }

    public function testDeleteUser()
    {
        $user = Usuario::first();

        $user->delete();
        
        $this->notSeeInDatabase('users', ['name' => 'Admin User']);
    }
}
