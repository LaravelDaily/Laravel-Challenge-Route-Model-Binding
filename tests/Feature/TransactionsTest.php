<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for task #1
     *
     * @testdox A Transaction's information can be viewed by navigating to the uri /transactions/{id}
     * @return void
     */
    public function test_transaction_can_be_viewed()
    {
        $transaction = Transaction::factory()
            ->for(User::factory())
            ->create();

        $response = $this->get("/transactions/{$transaction->id}");

        $response->assertStatus(200);
    }
}
