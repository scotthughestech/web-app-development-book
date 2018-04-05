<?php

namespace Tests\Feature;

use App\Organization;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Unauthenticateded users cannot view organizations.
     *
     * @return void
     */
    public function testNoUnauthenticatedUsers()
    {
        $response = $this->get('organizations');

        $response->assertRedirect('login');
    }

    /**
     * Authenticated users can view organizations.
     *
     * @return void
     */
    public function testYesAuthenticatedUsers()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Create an organization from scratch
        $org = new Organization;
        $org->user_id = $user->id;
        $org->name = 'Fake Company';
        $org->type_id = 1;
        $org->save();

        // Login user and get the organizations
        $response = $this->actingAs($user)
            ->get('organizations');

        // Assert that we see our fake org
        $response->assertSee('Fake Company');
    }

    /**
     * Authenticated users can create an org.
     *
     * @return void
     */
    public function testCanCreateAnOrg()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Set up POST array
        $post = [
            'user_id' => $user->id,
            'name' => 'Fake Company',
            'type_id' => 1
        ];

        // Login user and send POST request
        $response = $this->actingAs($user)
            ->post('organizations', $post);

        // Load the org from the database
        $org = Organization::first();

        // Assert the response includes the org's data
        $response->assertJson($org->toArray());
    }

    /**
     * Authenticated users can fetch a specific org.
     *
     * @return void
     */
    public function testFetchSpecificOrg()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Create an organization using the Organization factory
        $org = factory(Organization::class)->create(['user_id' => $user->id]);

        // Login user and send GET request to org's id
        $response = $this->actingAs($user)
            ->get('organizations/' . $org->id);

        // Assert the response includes the org's name
        $response->assertSee($org->name);
    }

    /**
     * Authenticated users can update an org.
     *
     * @return void
     */
    public function testUpdateAnOrg()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Create an organization using the Organization factory
        $org = factory(Organization::class)->create(['user_id' => $user->id]);

        // Setup the POST array and update the name
        $post = $org->toArray();
        $post['name'] = 'Changed the name';

        // Login user and send PUT request
        $this->actingAs($user)
            ->put('organizations/' . $org->id, $post);

        // Reload the org from the database
        $org = Organization::first();

        // Assert the organization's name has been changed
        $this->assertEquals('Changed the name', $org->name);
    }

    /**
     * Authenticated users can delete an org.
     *
     * @return void
     */
    public function testDeleteAnOrg()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Create an organization using the Organization factory
        $org = factory(Organization::class)->create(['user_id' => $user->id]);

        // Login user and send DELETE request to org's id
        $this->actingAs($user)->delete('organizations/' . $org->id);

        // Assert there are no orgs in the database
        $this->assertEmpty(Organization::all()->toArray());
    }

    /**
     * Organizations have to have valid data.
     *
     * @return void
     */
    public function testOrgsNeedValidData()
    {
        // Create a user using the User factory
        $user = factory(User::class)->create();

        // Set up an empty POST array
        $post = [];

        // Login user and send POST request
        $response = $this->actingAs($user)
            ->post('organizations', $post);

        // Assert the response has errors
        $response->assertSessionHasErrors();
    }
}
