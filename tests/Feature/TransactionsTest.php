<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homepage_redirects_to_transactions_index()
    {
        $this->get('/')
            ->assertRedirect('/transactions');
    }

    /** @test */
    public function it_loads_transactions_index()
    {
        $transactionsCount = 2;

        Transaction::factory()
            ->count($transactionsCount)
            ->for(User::factory())
            ->create();

        $this->assertDatabaseCount('transactions', $transactionsCount);

        $response = $this->get('/transactions')
            ->assertOk()
            ->assertViewHas('transactions')
            ->assertSeeTextInOrder(['View', 'Export', 'Duplicate']);

        $this->assertCount(
            $transactionsCount,
            $response->getOriginalContent()->getData()['transactions']
        );
    }

    /** @test */
    public function it_loads_a_transaction_show_page()
    {
        $transaction = $this->getTransaction();

        $this->get("/transactions/{$transaction->id}")
            ->assertOk()
            ->assertViewIs('transactions.show')
            ->assertViewHas('transaction')
            ->assertSeeText([
                $transaction->id,
                $transaction->description,
                $transaction->user->name
            ]);
    }

    /** @test */
    public function it_loads_a_transaction_export_page()
    {
        $transaction = $this->getTransaction();

        $this->get("/transactions/{$transaction->id}/export")
            ->assertOk()
            ->assertViewIs('transactions.export')
            ->assertViewHas('transaction')
            ->assertSeeText([
                $transaction->id,
                $transaction->description,
                $transaction->user->name
            ]);
    }

    /** @test */
    public function it_loads_a_transaction_duplication_page()
    {
        $transaction = $this->getTransaction();

        $this->get("/transactions/{$transaction->uuid}/duplicate")
            ->assertOk()
            ->assertViewIs('transactions.duplicate')
            ->assertViewHas('transaction')
            ->assertSeeText([
                $transaction->id,
                $transaction->description,
                $transaction->user->name
            ]);
    }

    private function getTransaction(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        return Transaction::factory()
            ->for(User::factory())
            ->create()
            ->load('user');
    }
}
