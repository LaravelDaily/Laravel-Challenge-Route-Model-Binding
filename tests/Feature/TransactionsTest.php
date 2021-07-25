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
}
