<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationTest extends TestCase
{
    /**
     * Only authenticated users can view organizations.
     *
     * @return void
     */
    public function testOnlyAuthenticatedUsers()
    {
        $response = $this->get('organizations');

        $response->assertRedirect('login');
    }
}
