@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5>All Customers</h5>

            <div class="container row">
                <div class="col-3"><strong class="text-success">Active Members</strong></div>
                <div class="col-3"></div>
                <div class="col-3"><input class="form-control me-2 light" type="search" placeholder="Search" aria-label="Search"></div>
                <div class="col-3 search-sort mb-3">
                    <button class="btn btn-light btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort by:
                        <select class="form-select me-2">
                            <option value="newest" selected>Newest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </button>
                </div>
            </div>
            

            <!-- Add Customer Button -->
            <!-- <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">
                <span class="material-icons">add</span> Add Customer
            </a> -->

            <!-- Customer Table -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Company</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <!-- Main Customer Row -->
                        <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target=".customer-details-{{ $customer->id }}">
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->company }}</td>
                            <td>{{ $customer->contact_phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->country }}</td>
                            <td>
                                <button class="btn {{ $customer->status == 'Active' ? 'btn-success' : 'btn-danger' }}">
                                    {{ $customer->status }}
                                </button>
                            </td>
                        </tr>
                        <!-- Address Rows -->
                        @forelse ($customer->addresses as $index => $address)
                        <tr class="collapse customer-details-{{ $customer->id }}">
                            <td colspan="1"></td> <!-- Empty cell to align with customer name -->
                            <td colspan="1"><strong>Address {{ $index + 1 }}</strong></td>
                            <td>{{ $address->address_number }}</td> <!-- Address Number under Phone Number -->
                            <td>{{ $address->address_street }}</td>  <!-- Address Street under Email -->
                            <td>{{ $address->address_city }}</td>    <!-- Address City under Country -->
                            <td colspan="1"></td> <!-- Empty cell to align with status -->
                        </tr>
                        @empty
                        <tr class="collapse customer-details-{{ $customer->id }}">
                            <td colspan="6">
                                No addresses found for this customer.
                            </td>
                        </tr>
                        @endforelse
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>

<!-- jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
        // Add click event to toggle row visibility
        $('.clickable-row').on('click', function() {
            // Collapse other rows except the clicked one
            $('.collapse').not($(this).nextAll('.customer-details-' + $(this).data('bs-target').split('-').pop())).collapse('hide');
            
            // Toggle the current row
            $(this).nextAll('.customer-details-' + $(this).data('bs-target').split('-').pop()).collapse('toggle');
        });
    });
</script>
@endsection
