<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();
        $this->artisan("db:seed");
    }
    
    /** @test */
    public function an_individual_transaction_view_should_show()
    {
        $transaction = Transaction::get()->random();
        
        $response = $this->get(route('transactions.show', $transaction));

        $response->assertStatus(200);
    }

    /** @test */
    public function an_transaction_should_export()
    {
        $transaction = Transaction::get()->random();
        
        $response = $this->get(route('transactions.export', $transaction));

        $response->assertStatus(200)
            ->assertSee($transaction->user->name);
    }

    /** @test */
    public function a_duplicate_transaction_should_load()
    {
        $transactions = Transaction::all();

        $transaction = $transactions->first(function ($transaction) {
            return ! is_numeric(substr($transaction->uuid, 0, 1));
        });

        $response = $this->get(route('transactions.duplicate', $transaction->uuid));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_duplicate_transaction_should_show_correct_information()
    {
        $transactions = Transaction::all();

        $transaction = $transactions->first(function ($transaction) {
            return is_numeric(substr($transaction->uuid, 0, 1)) && ! is_numeric(substr($transaction->uuid, 1, 1));
        });

        $response = $this->get(route('transactions.duplicate', $transaction->uuid));

        $response->assertStatus(200)
            ->assertSee($transaction->description)
            ->assertSee($transaction->created_at);
    }
}
