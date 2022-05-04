<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\JobStatus;
use App\Models\RemoteType;
use App\Models\Talent;
use App\Models\Title;
use App\Models\Country;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Business;

class AuthServiceTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    protected $admin;
    protected $admin_password;
    protected $admin_login_url = '/api/v1/admins/auth';

    protected $talent;
    protected $talent_password;
    protected $talent_login_url = '/api/v1/talents/auth';

    protected $business;
    protected $business_password;
    protected $business_login_url = '/api/v1/businesses/auth';

    public function setup() : void
    {
        parent::setup();

        $this->admin    = Admin::factory()->create([ 'password' => $this->admin_password = $this->faker->password(8) ]);
        $this->talent   = Talent::factory()->create([ 'password' => $this->talent_password = $this->faker->password(8) ]);
        $this->business = Business::factory()->create([ 'password' => $this->business_password = $this->faker->password(8) ]);

        // When I merge this with my branch, we will replace these with actual database values, rather than creating fake ones
        $this->title      = Title::factory()->create();
        $this->job_status = JobStatus::factory()->create();
        $this->country    = Country::factory()->count(1)->create();
        $this->currency   = Currency::factory()->count(1)->create();
        $this->industry = Industry::factory()->count(1)->create();

        $this->remote_talent_type = RemoteType::factory()->create();
    }

    public function test_admin_cannot_access_protected_resources_without_authentication()
    {
        $this->delete($this->admin_login_url)->assertUnauthorized();
    }

    public function test_admin_can_authenticate_with_correct_credentials()
    {
        $this->post($this->admin_login_url, [ 'email' => $this->admin->email, 'password' => $this->admin_password ])
            ->assertSuccessful();
    }

    public function test_admin_cannot_authenticate_with_incomplete_credentials()
    {
        $this->post($this->admin_login_url, [ 'email' => 'adminmail@doin.com', 'password' => $this->admin_password ])
            ->assertUnauthorized();
    }

    public function test_admin_cannot_authenticate_with_email_only()
    {
        $this->post($this->admin_login_url, [ 'email' => $this->admin->email ])
            ->assertStatus(422)
            ->assertJsonFragment([ 'message' => 'The password field is required.' ]);
    }

    public function test_admin_cannot_access_data_outside_admin_guard()
    {
        $token = $this->postJson($this->admin_login_url, [ 'email' => $this->admin->email, 'password' => $this->admin_password ])
           ->assertSuccessful()
           ->decodeResponseJson()['data']['token'];

        $this->delete($this->talent_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertUnauthorized();
        $this->delete($this->business_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertUnauthorized();
    }

    public function test_admin_can_logout()
    {
       $token = $this->postJson($this->admin_login_url, [ 'email' => $this->admin->email, 'password' => $this->admin_password ])
           ->assertSuccessful()
           ->decodeResponseJson()['data']['token'];

        $this->delete($this->admin_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertSuccessful();
    }

    /**
     * Talent Tests
     */
    public function test_talent_cannot_access_protected_resources_without_authentication()
    {
        $this->delete($this->talent_login_url)->assertUnauthorized();
    }

    public function test_talent_can_authenticate_with_correct_credentials()
    {
        $this->post($this->talent_login_url, [ 'email' => $this->talent->email, 'password' => $this->talent_password ])
            ->assertSuccessful();
    }

    public function test_talent_cannot_authenticate_with_invalid_credentials()
    {
        $this->post($this->talent_login_url, [ 'email' => $this->talent->email, 'password' => $this->admin_password ])
            ->assertUnauthorized();
    }

    public function test_talent_cannot_authenticate_with_email_only()
    {
        $this->post($this->talent_login_url, [ 'email' => $this->talent->email])
            ->assertStatus(422)
            ->assertJsonFragment([ 'message' => 'The password field is required.' ]);
    }

    public function test_talent_cannot_access_data_outside_the_talent_guard()
    {
        $token = $this->postJson($this->talent_login_url, [ 'email' => $this->talent->email, 'password' => $this->talent_password ])
            ->assertSuccessful()
            ->decodeResponseJson()['data']['token'];

        $this->delete($this->admin_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertUnauthorized();
        $this->delete($this->business_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertUnauthorized();
    }

   public function test_talent_can_logout()
   {
        $token = $this->postJson($this->talent_login_url, [ 'email' => $this->talent->email, 'password' => $this->talent_password ])
            ->assertSuccessful()
            ->decodeResponseJson()['data']['token'];

        $this->delete($this->talent_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertSuccessful();
   }

    /**
     * Business Tests
     */
   public function test_business_cannot_access_protected_resources_without_authentication()
   {
       $this->delete($this->business_login_url)->assertUnauthorized();
   }

   public function test_business_can_authenticate_with_correct_credentials()
   {
       $this->post($this->business_login_url, ['email' => $this->business->email, 'password' => $this->business_password])->assertSuccessful();
   }

   public function test_business_cannot_authenticate_with_invalid_credentials()
   {
        $this->post($this->business_login_url, ['email' => $this->business->email, 'password' => $this->admin_password])->assertUnauthorized();
   }

   public function test_business_cannot_authenticate_with_email_only()
   {
       $this->post($this->business_login_url,['email' => $this->business->email])
           ->assertStatus(422)
           ->assertJsonFragment(['message' => 'The password field is required.']);
   }

    public function test_business_cannot_access_data_outside_the_business_guard()
    {
        $token = $this->postJson($this->business_login_url, ['email' => $this->business->email, 'password' => $this->business_password])
            ->assertSuccessful()
            ->decodeResponseJson()['data']['token'];
        $this->delete($this->admin_login_url, [], ['Authorization' => "Bearer {$token}"])->assertUnauthorized();
        $this->delete($this->talent_login_url, [], ['Authorization' => "Bearer {$token}"])->assertUnauthorized();
    }

    public function test_business_can_logout()
    {
        $token = $this->postJson($this->business_login_url, [ 'email' => $this->business->email, 'password' => $this->business_password ])
            ->assertSuccessful()
            ->decodeResponseJson()['data']['token'];

        $this->delete($this->business_login_url, [], [ 'Authorization' => "Bearer {$token}" ])->assertSuccessful();
    }
}
