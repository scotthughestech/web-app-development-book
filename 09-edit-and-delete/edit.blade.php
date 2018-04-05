@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Organization</div>

        <div class="card-body">
            <organizations-edit :organization="{{ $organization }}"></organizations-edit>
        </div>
    </div>
@endsection
