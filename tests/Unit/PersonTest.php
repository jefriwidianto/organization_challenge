<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Printerous\Person;
use Printerous\Http\Controllers\PersonController;
use Printerous\Http\Requests\PersonRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Faker\Generator as Faker;

class PersonTest extends TestCase
{

    /*
	|--------------------------------------------------------------------------
	| Unit Testing for Person CRUD Eloquent
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
	        'id_organization' => $faker->numberBetween(1,3),
	        'avatar' =>  UploadedFile::fake()->image('avatar.jpg'),
        ];

        return $data;
    }

    public function test_form_validation()
    {
        $attributes = $this->createAttributes();
        $request = new PersonRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $passes = $validator->passes();
        $this->assertEquals(true, $passes);

        return $attributes;      
    }

    public function testCreatePerson()
    {
    	$data = PersonRequest::create('/action_create', 'POST', $this->test_form_validation());
    	$controller = new PersonController();
    	$response = $controller->action_create($data);

        $check = Person::where('name', $data['name'])->first();
        $this->assertEquals($data['name'], $check['name']);
    }

    #test jika gagal menyimpan database karena password kurag dari 6 char
    public function testUpdatePerson()
    {

	    $request1 = Person::orderBy('id', 'desc')->first();
	    $id = $request1->id;

        $dataq = [
            'name' => $faker->name,
	        'phone' => $request1->phone,
	        'email' => $request1->email,
	        'id_organization' => $request1->id_organization,
	        'avatar' =>  UploadedFile::fake()->image('avatar.jpg'),
        ];

	    $request = Request::create('/action_update', 'PUT', $dataq);

	    $controller = new PersonController();
    	$response = $controller->action_update($id, $request);

	    $this->assertEquals($dataq['name'], $request['name']);

    }

    public function testDeletePerson()
    {
    	$request1 = Person::orderBy('id', 'desc')->first();
	    $id = $request1->id;

	     $controller = new PersonController();
    	$response = $controller->delete($id);
	    $this->assertDatabaseMissing('person',['id'=> $id]);


    }
}
