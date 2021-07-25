@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transactions') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>User</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>${{ number_format($transaction->amount / 100, 2) }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                            class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('transactions.export', $transaction) }}"
                                            class="btn btn-sm btn-info">Export</a>
                                        <a href="{{ route('transactions.duplicate', $transaction) }}"
                                           class="btn btn-sm btn-warning">Duplicate</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection