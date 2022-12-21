@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transaction to Export') }}</div>

                <div class="card-body">
                    <b>Please check details:</b>
                    <br />
                    ID: {{ $transactions->id }}
                    <br />
                    Description: {{ $transactions->description }}
                    <br />
                    Amount: ${{ number_format($transactions->amount / 100, 2) }}
                    <br />
                    User: {{ $transactions->user->name }}
                    <br />
                    Created at: {{ $transactions->created_at }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
