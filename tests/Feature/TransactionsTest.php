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

    /**
     * Test for task #2
     *
     * @testdox A Transaction's export information can be viewed by navigating to the uri /transactions/{id}/export
     * @return void
     */
    public function test_transaction_can_be_exported()
    {
        $transaction = Transaction::factory()
            ->for(User::factory())
            ->create();

        $response = $this->get("/transactions/{$transaction->id}/export");

        $response->assertStatus(200);
    }

    /**
     * Test for task #3
     *
     * @testdox A Transaction's information can be reviewed for duplication by navigating to the uri /transactions/{uuid}/duplicate
     * @return void
     */
    public function test_transaction_can_be_duplicated()
    {
        $transaction = Transaction::factory()
            ->for(User::factory())
            ->create();

        $response = $this->get("/transactions/{$transaction->uuid}/duplicate");

        $response->assertStatus(200);
    }

    /**
     * Test for task #3
     *
     * @testdox The information shown when trying to duplicate a Transaction comes from the correct Transaction.
     * @return void
     */
    public function test_transaction_duplicate_view_shows_correct_transaction()
    {
        $transaction = Transaction::factory()
            ->for(User::factory())
            ->create();

        $response = $this->get("/transactions/{$transaction->uuid}/duplicate");

        // Check the $transaction variable inside the view has the correct id.
        $response->assertViewHas(['transaction.id' => $transaction->id]);
    }
}
