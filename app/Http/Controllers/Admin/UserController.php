<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Status,
    User,
    Upgrade,
    Role
};
use Hash;
use DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $user = User::all();
            return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('status', function (User $user) {
                return view('admin.status.default', [
                    'data' => $user
                ]);
            })
            ->addColumn('role', function (User $user) {
                return view('admin.user.role', [
                    'data' => $user
                ]);
            })
            ->addColumn('action', function (User $user) {
                return view('admin.user.action', [
                    'data' => $user
                ]);
            })
            ->make(true);
        }
        $statuses = Status::all();
        $roles = Role::all();

        return view('admin.user', [
            'statuses' => $statuses,
            'roles' => $roles
        ]);
    }
    public function verified(Request $request){
        if($request->ajax()){
            $upgrade = Upgrade::all();
            return DataTables::of($upgrade)
            ->addColumn('name', function (Upgrade $upgrade) {
                return $upgrade->user->name;
            })
            ->addColumn('ktp', function (Upgrade $upgrade) {
                return view('admin.verified.download', [
                    'data' => $upgrade->user->ktp->name
                ]);
            })
            ->addColumn('selfie', function (Upgrade $upgrade) {
                return view('admin.verified.download', [
                    'data' => $upgrade->user->selfie->name
                ]);
            })
            ->addColumn('tabungan', function (Upgrade $upgrade) {
                return view('admin.verified.download', [
                    'data' => $upgrade->user->tabungan->name
                ]);
            })
            ->addColumn('status', function (Upgrade $upgrade) {
                return view('admin.verified.status', [
                    'data' => $upgrade->status
                ]);
            })
            ->addColumn('action', function (Upgrade $upgrade) {
                if($upgrade->status == 'pending'){
                    return view('admin.verified.action', [
                        'data' => $upgrade->user
                    ]);
                } else {
                    return null;
                }
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.verified');
    }
    public function verified_declined($user){
        $user = User::findOrFail($user);
        $user->selfie_id = null;
        $user->ktp_id = null;
        $user->username = null;
        $user->tabungan_id = null;
        $user->save();
        
        $upgrade = Upgrade::where('user_id', $user->id)->first();
        $upgrade->status = 'failed';
        $upgrade->save();
        
        return redirect()->back()->with('success', 'Berhasil menolak verifikasi user!');
    }
    public function verified_add($user){
        $user = User::findOrFail($user);
        $role = Role::where('name', 'reseller')->first();
        
        $user->roles()->attach([$role->id]);
        $user->ktp_selfie_verified_at = \Carbon\Carbon::now();
        $user->tabungan_verified_at = \Carbon\Carbon::now();
        $user->save();

        $upgrade = Upgrade::where('user_id', $user->id)->first();
        $upgrade->status = 'success';
        $upgrade->save();
        
        return redirect()->back()->with('success', 'Berhasil memverifikasi user!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nomorhp' => 'required|unique:users',
            'email' => 'required|unique:users',
            'status' => 'required',
            'roles' => 'required',
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'nomorhp' => $request->nomorhp,
            'email' => $request->email,
            'status_id' => $request->status,
        ]);
        $user->roles()->attach($request->roles);
        return redirect()->back()->with('success','Berhasil menambahkan user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', ['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses = Status::all();
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'nomorhp' => 'required',
            'email' => 'required',
            'status' => 'required',
            'roles' => 'required',
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nomorhp = $request->nomorhp;
        $user->email = $request->email;
        $user->status_id =  $request->status;
        $user->save();
        $subcategory->categories()->detach();
        $user->roles()->attach($request->roles);
        return redirect()->back()->with('success', 'Berhasil merubah user!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','Berhasil menghapus user!');
    }
}
