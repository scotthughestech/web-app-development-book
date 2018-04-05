@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Browse Organization</div>

        <div class="card-body">
            <organizations-browse :organizations="{{ $organizations }}"></organizations-browse>
        </div>
    </div>
@endsection
