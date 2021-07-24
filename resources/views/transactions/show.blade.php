@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transaction Details') }}</div>

                <div class="card-body">
                    ID: {{ $transaction->id }}
                    <br />
                    Description: {{ $transaction->description }}
                    <br />
                    Amount: ${{ number_format($transaction->amount / 100, 2) }}
                    <br />
                    User: {{ $transaction->user->name }}
                    <br />
                    Created at: {{ $transaction->created_at }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection