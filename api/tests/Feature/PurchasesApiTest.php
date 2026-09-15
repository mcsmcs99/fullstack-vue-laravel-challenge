<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchasesApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_customers(): void
    {
        Customer::create(['name' => 'Cliente Teste', 'email' => 'cliente@teste.com']);

        $response = $this->getJson('/api/customers');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_lists_courses(): void
    {
        Course::create(['title' => 'Curso Teste', 'description' => null, 'price' => 99.90]);

        $response = $this->getJson('/api/courses');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_lists_purchases_with_customer_and_course(): void
    {
        $customer = Customer::create(['name' => 'Cliente Teste', 'email' => 'cliente@teste.com']);
        $course = Course::create(['title' => 'Curso Teste', 'description' => null, 'price' => 99.90]);

        Purchase::create([
            'customer_id' => $customer->id,
            'course_id' => $course->id,
            'amount' => $course->price,
            'status' => 'pending',
            'purchased_at' => '2026-01-01 10:00:00',
        ]);

        $response = $this->getJson('/api/purchases');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.customer.name', 'Cliente Teste')
            ->assertJsonPath('data.0.course.title', 'Curso Teste');
    }

    public function test_it_filters_purchases_by_status(): void
    {
        $customer = Customer::create(['name' => 'Cliente Teste', 'email' => 'cliente@teste.com']);
        $course = Course::create(['title' => 'Curso Teste', 'description' => null, 'price' => 99.90]);

        Purchase::create([
            'customer_id' => $customer->id,
            'course_id' => $course->id,
            'amount' => $course->price,
            'status' => 'pending',
            'purchased_at' => '2026-01-01 10:00:00',
        ]);

        Purchase::create([
            'customer_id' => $customer->id,
            'course_id' => $course->id,
            'amount' => $course->price,
            'status' => 'paid',
            'purchased_at' => '2026-01-02 10:00:00',
        ]);

        $response = $this->getJson('/api/purchases?status=paid');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.status', 'paid');
    }
}
