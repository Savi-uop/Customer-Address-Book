@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customer Management</h1>
        <!-- Add Customer Button to Trigger Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
            <i class="bi bi-plus-lg"></i> Add Customer
        </button>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerModalLabel">Add New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            <!-- Customer Details -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>

                            <!-- Address Section -->
                            <h5>Address Details</h5>
                            <div id="address-section">
                                <!-- Initial Address Block -->
                                <div class="address-block mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="address_number" class="form-label">Address Number</label>
                                            <input type="text" class="form-control" name="addresses[0][address_number]" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="address_street" class="form-label">Street</label>
                                            <input type="text" class="form-control" name="addresses[0][address_street]" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="address_city" class="form-label">City</label>
                                            <input type="text" class="form-control" name="addresses[0][address_city]" required>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger mt-4 remove-address" style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to Add More Addresses -->
                            <button type="button" id="add-address" class="btn btn-secondary mb-3">Add Address</button>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Dynamic Address Fields -->
    <script>
        let addressIndex = 1; // Start after the first address (index 0)

        document.getElementById('add-address').addEventListener('click', function() {
            const addressSection = document.getElementById('address-section');

            // Create a new address block
            const newAddressBlock = document.createElement('div');
            newAddressBlock.classList.add('address-block', 'mb-3');
            newAddressBlock.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <label for="address_number" class="form-label">Address Number</label>
                        <input type="text" class="form-control" name="addresses[${addressIndex}][address_number]" required>
                    </div>
                    <div class="col-md-5">
                        <label for="address_street" class="form-label">Street</label>
                        <input type="text" class="form-control" name="addresses[${addressIndex}][address_street]" required>
                    </div>
                    <div class="col-md-3">
                        <label for="address_city" class="form-label">City</label>
                        <input type="text" class="form-control" name="addresses[${addressIndex}][address_city]" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger mt-4 remove-address">Delete</button>
                    </div>
                </div>
            `;

            // Append the new address block to the address section
            addressSection.appendChild(newAddressBlock);

            // Add event listener to the remove button for this address block
            newAddressBlock.querySelector('.remove-address').addEventListener('click', function() {
                newAddressBlock.remove();
            });

            // Increment the index for the next address
            addressIndex++;
        });

        // Handle remove button for the first address (hidden initially)
        document.querySelector('.remove-address').addEventListener('click', function() {
            this.closest('.address-block').remove();
        });
    </script>
@endsection
