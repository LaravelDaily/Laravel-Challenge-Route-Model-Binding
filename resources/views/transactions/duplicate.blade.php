@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transaction to Duplicate') }}</div>

                <div class="card-body">
                    <b>Please check details for duplication:</b>
                    <br />
                    ID: {{ $transaction->id }}
                    <br />
                    Description: {{ $transaction->description }}
                    <br />
                    Amount: ${{ number_format($transaction->amount / 100, 2) }}
                    <br />
                    User: {{ $transaction->user['name'] }}
                                        <!--here i changed from ->user->name to ->user['name'] because the result returns a result of the
                        query and not an object instance that you can access like that-->
                    <br />
                    Created at: {{ $transaction->created_at }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection