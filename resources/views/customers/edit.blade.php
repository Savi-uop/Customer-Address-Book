{{-- resources/views/customers/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
        </div>
        <div class="mb-3">
            <label for="addresses" class="form-label">Addresses</label>
            <textarea class="form-control" id="addresses" name="addresses[]" rows="3" required>{{ implode(', ', $customer->addresses->pluck('address')->toArray()) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <span class="material-icons">save</span> Update Customer
        </button>
    </form>
@endsection
