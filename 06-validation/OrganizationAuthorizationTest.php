<?php

namespace Tests\Feature;

use App\Organization;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Users should not be able to see other users' orgs.
     *
     * @return void
     */
    public function testUsersShouldNotSeeOtherUsersOrgs()
    {
        // Create two users
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Create an organization for both users
        $org1 = factory(Organization::class)->create(['user_id' => $user1->id]);
        $org2 = factory(Organization::class)->create(['user_id' => $user2->id]);

        // Acting as user 1, get the organizations
        $response = $this->actingAs($user1)->get('organizations');

        // Assert that you don't see the second org in the results
        $response->assertDontSee($org2->name);
    }

    /**
     * Users cannot view another user's org.
     *
     * @return void
     */
    public function testUsersCannotViewAnotherUsersOrg()
    {
        // Create two users
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Create an organization for the second user.
        $org = factory(Organization::class)->create(['user_id' => $user2->id]);

        // Acting as user 1, try to fetch the second's user's org
        $response = $this->actingAs($user1)->get('organizations/' . $org->id);

        // Assert that this is forbidden
        $response->assertForbidden();
    }

    /**
     * Users cannot update another user's org.
     *
     * @return void
     */
    public function testUsersCannotUpdateAnotherUsersOrg()
    {
        // Create two users
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Create an organization for the second user.
        $org = factory(Organization::class)->create(['user_id' => $user2->id]);

        // Acting as user 1, try to update the second's user's org
        $post = $org->toArray();
        $post['name'] = 'Is this Changeable?';
        $response = $this->actingAs($user1)->put('organizations/' . $org->id, $post);

        // Assert that this is forbidden
        $response->assertForbidden();
    }

    /**
     * Users cannot delete another user's org.
     *
     * @return void
     */
    public function testUsersCannotDeleteAnotherUsersOrg()
    {
        // Create two users
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Create an organization for the second user.
        $org = factory(Organization::class)->create(['user_id' => $user2->id]);

        // Acting as user 1, try to delete the second's user's org
        $response = $this->actingAs($user1)->delete('organizations/' . $org->id);

        // Assert that this is forbidden
        $response->assertForbidden();
    }
}
