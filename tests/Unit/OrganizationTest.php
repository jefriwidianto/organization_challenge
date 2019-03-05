<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Printerous\Organization;
use Printerous\Http\Controllers\OrganizationController;
use Printerous\Http\Requests\OrganizationRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Faker\Generator as Faker;

class OrganizationTest extends TestCase
{
	
    /*
	|--------------------------------------------------------------------------
	| Unit Testing for Organization CRUD Eloquent
	|--------------------------------------------------------------------------
	|
	| * @return void
	| * validation FormRequest testing
	| * create testing with controller <success>
	| * update testing with controller <success>
	| * delete testing with controller <success>
	| 
	*/

    public function setUp()
	{
	    parent::setUp();
	    
	}

	private function createAttributes()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'name' => $faker->name,
	        'phone' => $faker->e164PhoneNumber,
	        'email' => $faker->unique()->companyEmail,
	        'website' => $faker->domainName,
	        'company' => $faker->company,
	        'id_accountmgr' => $faker->numberBetween(1,3),
	        'logo' =>  UploadedFile::fake()->image('avatar.jpg'),
        ];

        return $data;
    }

    public function test_form_validation()
    {
        $attributes = $this->createAttributes();
        $request = new OrganizationRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $passes = $validator->passes();
        $this->assertEquals(true, $passes);

        return $attributes;      
    }

    public function testCreateOrganization()
    {
    	$data = OrganizationRequest::create('/action_create', 'POST', $this->test_form_validation());
    	$controller = new OrganizationController();
    	$response = $controller->action_create($data);

        $check = Organization::where('name', $data['name'])->first();
        $this->assertEquals($data['name'], $check['name']);

        return $check;
    }

    #test jika gagal menyimpan database karena password kurag dari 6 char
    public function testUpdateOrganization()
    {

	    $request1 = Organization::orderBy('id', 'desc')->first();
	    $id = $request1->id;

        $dataq = [
            'name' => $faker->name,
	        'phone' => $request1->phone,
	        'email' => $request1->email,
	        'website' => $request1->website,
	        'company' => $request1->company,
	        'id_accountmgr' => $request1->id_accountmgr,
	        'logo' =>  UploadedFile::fake()->image('avatar.jpg'),
        ];

	    $request = Request::create('/action_update', 'PUT', $dataq);

	    $controller = new OrganizationController();
    	$response = $controller->action_update($id, $request);

	    $this->assertEquals($dataq['name'], $request['name']);

    }

    public function testDeleteOrganization()
    {
    	$request1 = Organization::orderBy('id', 'desc')->first();
	    $id = $request1->id;

	     $controller = new OrganizationController();
    	$response = $controller->delete($id);
	    $this->assertDatabaseMissing('organization',['id'=> $id]);


    }

}