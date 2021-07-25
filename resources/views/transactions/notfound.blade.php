@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-danger py-2">
                <a type="button" class="btn btn-info" href="{{ url('/') }}">Back</a>
                Not found
            </div>
        </div>
    </div>
</div>
@endsection