<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\StorageFileTrait;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    use StorageFileTrait;
    private $user;
    private $role;
    public function __construct()
    {
        $this->role = new Role;
        $this->user = new User; 
    }

    //My infomation
    public function myInfo(){
        return view('admin-views.pages.manage.my-info.index');
    }
    //employee
    public function empIndex()
    {
      $employees = $this->role->where('name', 'admin')->first()->users()->get();
      return view('admin-views.pages.manage.employees.index',compact('employees'));
    }

    public function empCreate()
    {
        return view('admin-views.pages.manage.employees.add');
    }
    public function empStore(Request $request)
    {
        try {
           
            $userMapping = [
                'name' => $request->name,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => $request->password,
                'salary_per_month' => $request->salary_per_month,
                'active' => $request->active,
                'description' => $request->description,
            ];
            
    
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/employees/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                
            }
            
            $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/employees/' . Str::Slug($request->name) . '/id-card/front');
            if (!empty($idCardFront)) {
                $userMapping['id_card_front'] = $idCardFront['file_path'];
                
            }
            
            $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/employees/' . Str::Slug($request->name) . '/id-card/back');
            if (!empty($idCardBack)) {
                $userMapping['id_card_back'] = $idCardBack['file_path'];
                
            }
            $userCreated = $this->user->create($userMapping);
            $userCreated->roles()->attach(2);
            return redirect()->route('employees.index')->with('success','Thêm mới nhân viên thành công!');
            
          
          } catch (\Exception $e) {
                return redirect()->route('employees.index')->with('error','Thêm mới nhân viên thất bại! Đã xảy ra lỗi');
          
            }
    }
    public function empEdit($id)
    {
        try{
            $employee = $this->user->find($id);
            return view('admin-views.pages.manage.employees.edit',compact('employee'));
        }catch(\Exception $e){

        }
       
    }
    public function empUpdate(Request $request, $id)
    {
        try {
            $userOnUpdated = $this->user->find($id);


            $userMapping = [
                'name' => $request->name,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                // 'email' => $request->email,
                // 'password' =>  $request->password,
            
                'salary_per_month' => $request->salary_per_month,
                'active' => $request->active,
                'description' => $request->description,
            ];

            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/employees/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                
            }
            $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/employees/' . Str::Slug($request->name) . '/id-card/front');
            if (!empty($idCardFront)) {
                $userMapping['id_card_front'] = $idCardFront['file_path'];
                
            }
            $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/employees/' . Str::Slug($request->name) . '/id-card/back');
            if (!empty($idCardBack)) {
                $userMapping['id_card_back'] = $idCardBack['file_path'];
                
            }
            $userOnUpdated->update($userMapping);
            $userOnUpdated->roles()->syncWithoutDetaching(2);

            return redirect()->route('employees.index')->with('success','Cập nhật nhân viên thành công!');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error','Cập nhật nhân viên thất bại! Có lỗi xảy ra');
            // dd($e);
        }
    }
    public function empDelete($id)
    {
        try {
            //code...
            $userOnDeleted = $this->user->find($id);

            $userImagesDirectory = 'storage/admin-page/images/employees/' . Str::slug($userOnDeleted->name); 
            
        
            if(File::exists($userImagesDirectory)){
                File::deleteDirectory(public_path($userImagesDirectory));
            }
            $userOnDeleted->roles()->detach();
            $userOnDeleted->delete();
           

            return redirect()->route('employees.index')->with('success', 'Xóa nhân viên thành công!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('employees.index')->with('error', 'Xóa nhân viên thất bại! Đã xảy ra lỗi');
          
        }
     
    
    }




    //Artist

    public function artistIndex()
    {
        $artists = $this->role->where('name', 'singer')->first()->users()->get();
        return view('admin-views.pages.manage.artists.index',compact('artists'));
    }

    public function artistCreate()
    {
        return view('admin-views.pages.manage.artists.add');
    }
    public function artistStore(Request $request)
    {
        try {
           
            $userMapping = [
                'name' => $request->name,
                'nickname' => $request->nickname,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' =>  $request->password,
          
                'coin' => $request->coin,
                'active' => $request->active,
                'description' => $request->description,
            ];
            
    
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/artists/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                
            }
            
            $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/artists/' . Str::Slug($request->name) . '/id-card/front');
            if (!empty($idCardFront)) {
                $userMapping['id_card_front'] = $idCardFront['file_path'];
                
            }
            
            $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/artists/' . Str::Slug($request->name) . '/id-card/back');
            if (!empty($idCardBack)) {
                $userMapping['id_card_back'] = $idCardBack['file_path'];
                
            }
            $userCreated = $this->user->create($userMapping);
            $userCreated->roles()->attach(3);
            return redirect()->route('artists.index')->with('success','Thêm mới Nghệ sĩ thành công!');
            
          
          } catch (\Exception $e) {
                return redirect()->route('artists.index')->with('error','Thêm mới Nghệ sĩ thất bại! Đã xảy ra lỗi');
                
            }
    }
    public function artistEdit($id)
    {
        try{
            $artist = $this->user->find($id);
            return view('admin-views.pages.manage.artists.edit',compact('artist'));
        }catch(\Exception $e){

        }
    }
    public function artistUpdate(Request $request, $id)
    {
        try {
            $userOnUpdated = $this->user->find($id);


            $userMapping = [
                'name' => $request->name,
                'nickname' => $request->nickname,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,

                // 'email' => $request->email,
                // 'password' =>  $request->password,
                'coin' => $request->coin,
                'active' => $request->active,
                'description' => $request->description,
            ];

            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/artists/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                
            }
            $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/artists/' . Str::Slug($request->name) . '/id-card/front');
            if (!empty($idCardFront)) {
                $userMapping['id_card_front'] = $idCardFront['file_path'];
                
            }
            $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/artists/' . Str::Slug($request->name) . '/id-card/back');
            if (!empty($idCardBack)) {
                $userMapping['id_card_back'] = $idCardBack['file_path'];
                
            }
            $userOnUpdated->update($userMapping);
            $userOnUpdated->roles()->syncWithoutDetaching(3);
            return redirect()->route('artists.index')->with('success','Cập nhật nghệ sĩ thành công!');
        } catch (\Exception $e) {
            return redirect()->route('artists.index')->with('error','Cập nhật nghệ sĩ thất bại! Có lỗi xảy ra');
            // dd($e);
        }
    }
    public function artistDelete($id)
    {
        try {
            //code...
            $userOnDeleted = $this->user->find($id);

            $userImagesDirectory = 'storage/admin-page/images/artists/' . Str::slug($userOnDeleted->name); 
            
        
            if(File::exists($userImagesDirectory)){
                File::deleteDirectory(public_path($userImagesDirectory));
            }
            $userOnDeleted->roles()->detach();
            $userOnDeleted->delete();
            return redirect()->route('artists.index')->with('success', 'Xóa nghệ sĩ thành công!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('artists.index')->with('error', 'Xóa nghệ sĩ thất bại! Đã xảy ra lỗi');
        }
    }



    //Customer


        public function customerIndex()
        {
            $customers = $this->role->where('name', 'user')->first()->users()->get();
            return view('admin-views.pages.manage.customers.index',compact('customers'));
        }
    
        public function customerCreate()
        {
            return view('admin-views.pages.manage.customers.add');
        }
        public function customerStore(Request $request)
        {
            try {
               
                $userMapping = [
                    'name' => $request->name,
                    'date_of_birth' => $request->dob,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'password' =>  $request->password,
                   
                    'coin' => $request->coin,
                    'active' => $request->active,
                    'description' => $request->description,
                ];
                
        
                $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/customers/' . Str::Slug($request->name) . '/avatar');
                if (!empty($avatarImageUploaded)) {
                    $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                    
                }
                
                $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/customers/' . Str::Slug($request->name) . '/id-card/front');
                if (!empty($idCardFront)) {
                    $userMapping['id_card_front'] = $idCardFront['file_path'];
                    
                }
                
                $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/customers/' . Str::Slug($request->name) . '/id-card/back');
                if (!empty($idCardBack)) {
                    $userMapping['id_card_back'] = $idCardBack['file_path'];
                    
                }
                $userCreated = $this->user->create($userMapping);
                $userCreated->roles()->attach(4);
                return redirect()->route('customers.index')->with('success','Thêm mới Khách hàng thành công!');
                
              
              } catch (\Exception $e) {
                    return redirect()->route('customers.index')->with('error','Thêm mới Khách hàng thất bại! Đã xảy ra lỗi');
            
                }
          
        }

        public function customerEdit($id)
        {
            try{
                $customer = $this->user->find($id);
                return view('admin-views.pages.manage.customers.edit',compact('customer'));
            }catch(\Exception $e){
    
            }
        }

        public function customerUpdate(Request $request, $id)
        {
            try {
                $userOnUpdated = $this->user->find($id);
    
    
                $userMapping = [
                    'name' => $request->name,
                    'date_of_birth' => $request->dob,
                    'gender' => $request->gender,
                    // 'email' => $request->email,
                    // 'password' =>  $request->password,

                    'coin' => $request->coin,
                    'active' => $request->active,
                    'description' => $request->description,
                ];
    
                $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/customers/' . Str::Slug($request->name) . '/avatar');
                if (!empty($avatarImageUploaded)) {
                    $userMapping['avatar'] = $avatarImageUploaded['file_path'];
                    
                }
                $idCardFront = $this->storageFileUpload($request, 'id_card_front', 'admin-page/images/customers/' . Str::Slug($request->name) . '/id-card/front');
                if (!empty($idCardFront)) {
                    $userMapping['id_card_front'] = $idCardFront['file_path'];
                    
                }
                $idCardBack = $this->storageFileUpload($request, 'id_card_back', 'admin-page/images/customers/' . Str::Slug($request->name) . '/id-card/back');
                if (!empty($idCardBack)) {
                    $userMapping['id_card_back'] = $idCardBack['file_path'];
                    
                }
                $userOnUpdated->update($userMapping);
                $userOnUpdated->roles()->syncWithoutDetaching(4);
                return redirect()->route('customers.index')->with('success','Cập nhật nghệ sĩ thành công!');
            } catch (\Exception $e) {
                return redirect()->route('customers.index')->with('error','Cập nhật nghệ sĩ thất bại! Có lỗi xảy ra');
               
            }

        }
        public function customerDelete($id)
        {
            try {
                //code...
                $userOnDeleted = $this->user->find($id);
    
                $userImagesDirectory = 'storage/admin-page/images/customers/' . Str::slug($userOnDeleted->name); 
                
            
                if(File::exists($userImagesDirectory)){
                    File::deleteDirectory(public_path($userImagesDirectory));
                }
                $userOnDeleted->roles()->detach();
                $userOnDeleted->delete();
                return redirect()->route('customers.index')->with('success', 'Xóa khách hàng thành công!');
            } catch (\Exception $e) {
          
                return redirect()->route('customers.index')->with('error', 'Xóa khách hàng thất bại! Đã xảy ra lỗi');
                
            }
        }
}
