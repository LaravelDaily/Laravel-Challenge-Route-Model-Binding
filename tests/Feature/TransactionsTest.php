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

    protected $transaction;

    public function setUp(): void
    {
        parent::setUp();

        $this->transaction = Transaction::factory()
            ->for(User::factory())
            ->create();
    }

    /**
     * @testdox A Transaction's information can be viewed by navigating to the uri /transactions/{id}
     * @group task_1
     */
    public function test_transaction_can_be_viewed()
    {
        $response = $this->get("/transactions/{$this->transaction->id}");

        $response->assertStatus(200);
    }

    /**
     * @testdox A Transaction's export information can be viewed by navigating to the uri /transactions/{id}/export
     * @group task_2
     */
    public function test_transaction_can_be_exported()
    {
        $response = $this->get("/transactions/{$this->transaction->id}/export");

        $response->assertStatus(200);
    }

    /**
     * @testdox A Transaction's information can be reviewed for duplication by navigating to the uri /transactions/{uuid}/duplicate
     * @group task_3
     */
    public function test_transaction_can_be_duplicated()
    {
        $response = $this->get("/transactions/{$this->transaction->uuid}/duplicate");

        $response->assertStatus(200);
    }

    /**
     * @testdox The information shown when trying to duplicate a Transaction comes from the correct Transaction
     * @group task_3
     */
    public function test_transaction_duplicate_view_shows_correct_transaction()
    {
        $this->seed();

        $response = $this->get("/transactions/{$this->transaction->uuid}/duplicate");

        // Check the $transaction variable inside the view has the correct id.
        $response->assertViewHas(['transaction.id' => $this->transaction->id]);
        $response->assertSeeText("ID: {$this->transaction->id}");
    }
}
