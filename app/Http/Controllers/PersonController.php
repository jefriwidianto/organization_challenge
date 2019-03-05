<?php

namespace Printerous\Http\Controllers;

use Illuminate\Http\Request;

use Printerous\Http\Requests\PersonRequest;

use Illuminate\Support\Facades\Auth;

use Alert;

use DataTables;

use Printerous\Person;

use Printerous\Organization;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display_data(){
        $person = Person::leftjoin('organization', 'person.id_organization', '=', 'organization.id')->select(['organization.name as name_orgz', 'organization.phone', 'organization.email', 'organization.id_accountmgr', 'person.name', 'person.id', 'person.email as email_person', 'person.phone as phone_person', 'person.avatar as avatar']);
    	return \DataTables::of($person)
    	->addColumn('action', function($row) {
            if (Auth::user()->jabatan == 1 && $row->id_accountmgr == Auth::user()->id){
                return '
                <a href="/person/update_person/'. $row->id .'" class="btn btn-warning">Edit</a>
                                        
                <a href="/person/delete_person/'. $row->id .'" class="btn btn-danger">Hapus</a>

                <a href="/person/view_person/'. $row->id .'" class="btn btn-primary">View</a>';
            }else{
                return '<a href="/person/view_person/'. $row->id .'" class="btn btn-primary">View</a>';
            }
        })
       	->make(true);
    }

    public function index(){
    	return view('person');
    }

    public function create(){
        $organization = Organization::all();
        return view('create_person', compact('organization'));
    }

    public function action_create(PersonRequest $data){

        try{
         $avatarName = $data->name.'.'.$data->avatar->getClientOriginalExtension();

         $data->avatar->storeAs('avatar',$avatarName);

            Person::create([
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'avatar' => $avatarName,
                'id_organization' => $data->id_organization
            ]);

            return redirect('/person')->with(['success' => '<strong>' . $data->name . '</strong> Telah disimpan']);
        }catch(\Exception $e) {
            return redirect('/person/create_person')->with(['error' => 'error, kontol']);
        }
            
    }

    public function update($id){
        $person = Person::find($id);
        $organization = Organization::all()->pluck('name','id');
        
        return view('update_person', compact('person', 'organization'));
    }

    public function action_update($id, Request $request){
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        if (request()->avatar != '') {
            $avatarName = $request->name.'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatar',$avatarName);
        }else{
            $avatarName = $request->name;
        }


        $person = Person::find($id);
        $person->name = $request->name;
        $person->phone = $request->phone;
        $person->email = $request->email;
        $person->id_organization = $request->id_organization;
        if (request()->avatar != '') {
            $person->avatar = $avatarName;
        }else{
            $person->avatar = $person->avatar;
        }
        $person->save();
        

        return redirect('/person')->with(['success' => '<strong>' . $request->name . '</strong> Telah Berhasil diupdate']);
    }

    public function delete($id){
        $person = Person::find($id);
        $person->delete();
        return redirect('/person')->with(['success' => '<strong>' . $person->name . '</strong> Telah dihapus']);
    }

    public function view($id){
        $person = Person::join('organization', 'person.id_organization', '=', 'organization.id')->select(['organization.id', 'organization.name as name_orgz', 'organization.phone', 'organization.email', 'organization.id_accountmgr', 'person.name', 'person.email as email_person', 'person.phone as phone_person', 'person.avatar as avatar'])->where('person.id', '=', $id)->orderBy('name_orgz')->get();
        
        return view('view_person', compact('person'));
    }
}
