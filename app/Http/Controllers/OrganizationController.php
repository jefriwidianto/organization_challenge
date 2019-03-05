<?php

namespace Printerous\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Printerous\Http\Requests\OrganizationRequest;

use DataTables;

use Printerous\Organization;

class OrganizationController extends Controller
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
        $posts = Organization::leftjoin('person', 'organization.id', '=', 'person.id_organization')
            ->select(['organization.id', 'organization.name as name_orgz', 'organization.phone', 'organization.email', 'organization.id_accountmgr', 'organization.website', 'organization.company', 'person.name'])->orderBy('organization.id');
    	return \DataTables::of($posts)
    	->addColumn('action', function($row) {
            if (Auth::user()->jabatan == 1 && $row->id_accountmgr == Auth::user()->id){
                return '
                <a href="/organization/update_organization/'. $row->id .'" class="btn btn-warning">Edit</a>
                                        
                <a href="/organization/delete_organization/'. $row->id .'" class="btn btn-danger">Hapus</a> 

                <a href="/organization/view_organization/'. $row->id .'" class="btn btn-primary">View</a> ';
            }else{ 
                return '<a href="/organization/view_organization/'. $row->id .'" class="btn btn-primary">View</a> ';
            }
        })
       	->make(true);
    }

    public function index(){
    	return view('organization');
    }

    public function create(){
    	return view('create_organization');
    }

    public function action_create(OrganizationRequest $data){

        $avatarName = $data->name.'.'.$data->logo->getClientOriginalExtension();
        $data->logo->storeAs('logo',$avatarName);
        
    	Organization::create([
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
            'company' => $data->company,
            'website' => $data->website,
            'id_accountmgr' => $data->id_accountmgr,
            'logo' => $avatarName
        ]);

        return redirect('/organization')->with(['success' => '<strong>' . $data->name . '</strong> Telah disimpan']);
    }

    public function update($id){
    	$organization = Organization::find($id);
    	
    	return view('update_organization', ['organization' => $organization]);
    }

    public function action_update($id, Request $request){
        
    	$this->validate($request,[
    		'name' => 'required',
    		'phone' => 'required',
    		'email' => 'required',
            'website' => 'required',
            'company' => 'required',
        ]);

        if ($request->logo != '') {
            $avatarName = $request->name.'.'.$request->logo->getClientOriginalExtension();
            $request->logo->storeAs('logo',$avatarName);
        }else{
            $avatarName = $request->name;
        }

    	$organization = Organization::find($id);
    	$organization->name = $request->name;
    	$organization->phone = $request->phone;
    	$organization->email = $request->email;
        if ($request->logo != '') {
            $organization->logo = $avatarName;
        }else{
            $organization->logo = $organization->logo;
        }
        $organization->website = $request->website;
        $organization->company = $request->company;
    	$organization->save();
    	
    	return redirect('/organization')->with(['success' => '<strong>' . $request->name . '</strong> Telah diperbaharui']);
    }

    public function delete($id){
    	$organization = Organization::find($id);
	    $organization->delete();
	    return redirect('/organization')->with(['success' => '<strong>' . $organization->name . '</strong> Telah dihapus']);
    }

    public function view($id){
        $organization = Organization::find($id);
        $person = Organization::join('person', 'organization.id', '=', 'person.id_organization')->select(['organization.id', 'organization.name as name_orgz', 'organization.phone', 'organization.logo', 'organization.website', 'organization.company', 'organization.email', 'organization.id_accountmgr', 'organization.logo', 'person.name', 'person.email as email_person', 'person.phone as phone_person'])->where('organization.id', '=', $id)->get();
        
        return view('view_organization', ['person' => $person, 'organization' => $organization]);
    }
}