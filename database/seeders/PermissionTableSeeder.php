<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PERMISSIONS

        //Category
        Permission::create(['name' => 'Category_Index',]);
        Permission::create(['name' => 'Category_Create',]);
        Permission::create(['name' => 'Category_Update',]);
        Permission::create(['name' => 'Category_Destroy',]);
        Permission::create(['name' => 'Category_Search',]);

        //Product
        Permission::create(['name' => 'Product_Index',]);
        Permission::create(['name' => 'Product_Create',]);
        Permission::create(['name' => 'Product_Update',]);
        Permission::create(['name' => 'Product_Destroy',]);
        Permission::create(['name' => 'Product_Search',]);

        //Sale
        Permission::create(['name' => 'Sale_Index',]);

        //Role
        Permission::create(['name' => 'Role_Index',]);
        Permission::create(['name' => 'Role_Create',]);
        Permission::create(['name' => 'Role_Update',]);
        Permission::create(['name' => 'Role_Destroy',]);
        Permission::create(['name' => 'Role_Search',]);
        
        //Permiso
        Permission::create(['name' => 'Permiso_Index',]);
        Permission::create(['name' => 'Permiso_Create',]);
        Permission::create(['name' => 'Permiso_Update',]);
        Permission::create(['name' => 'Permiso_Destroy',]);
        Permission::create(['name' => 'Permiso_Search',]);

        //Asignar
        Permission::create(['name' => 'Asignar_Index',]);

        //User
        Permission::create(['name' => 'User_Index',]);
        Permission::create(['name' => 'User_Create',]);
        Permission::create(['name' => 'User_Update',]);
        Permission::create(['name' => 'User_Destroy',]);
        Permission::create(['name' => 'User_Search',]);

        //Coin
        Permission::create(['name' => 'Coin_Index',]);
        Permission::create(['name' => 'Coin_Create',]);
        Permission::create(['name' => 'Coin_Update',]);
        Permission::create(['name' => 'Coin_Destroy',]);
        Permission::create(['name' => 'Coin_Search',]);

        //Cashout
        Permission::create(['name' => 'Cashout_Index',]);

        //Report
        Permission::create(['name' => 'Report_Index',]);

        //Company
        Permission::create(['name' => 'Company_Index',]);
        Permission::create(['name' => 'Company_Create',]);
        Permission::create(['name' => 'Company_Update',]);
        Permission::create(['name' => 'Company_Destroy',]);
        Permission::create(['name' => 'Company_Search',]);

        //ROLES

        //Admin
        $admin= Role::create(['name' => 'Admin']);

        //Empleado
        $empleado = Role::create(['name' => 'Empleado']);
        
        $admin ->syncPermissions([

        'Category_Index',
        'Category_Create',
        'Category_Update',
        'Category_Destroy',
        'Category_Search',
        'Product_Index',
        'Product_Create',
        'Product_Update',
        'Product_Destroy',
        'Product_Search',
        'Sale_Index',
        'Role_Index',
        'Role_Create',
        'Role_Update',
        'Role_Destroy',
        'Role_Search',
        'Permiso_Index',
        'Permiso_Create',
        'Permiso_Update',
        'Permiso_Destroy',
        'Permiso_Search',
        'Asignar_Index',
        'User_Index',
        'User_Create',
        'User_Update',
        'User_Destroy',
        'User_Search',
        'Coin_Index',
        'Coin_Create',
        'Coin_Update',
        'Coin_Destroy',
        'Coin_Search',
        'Cashout_Index',
        'Report_Index',
        'Company_Index',
        'Company_Create',
        'Company_Update',
        'Company_Destroy',
        'Company_Search',
        ]);

       // $user=User::find(1);
       // $user->syncRoles('Admin');
    }
}
