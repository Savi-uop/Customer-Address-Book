@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Project List</h4>

    <!-- Add Project Button to Trigger Modal -->
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#projectModal">
                <span class="material-icons">Add Project</span> 
            </button>
        </div>
    </div>

    <!-- Projects Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Customers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        @foreach($project->customers as $customer)
                            {{ $customer->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td class="col-2">
                        <!-- Edit Button to Trigger Modal -->
                        <button class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editProjectModal" 
                                data-id="{{ $project->id }}" 
                                data-name="{{ $project->name }}" 
                                data-description="{{ $project->description }}" 
                                data-customers="{{ $project->customers->pluck('id')->join(',') }}">
                            <span class="material-icons">edit</span>
                        </button>

                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm delete-project" data-id="{{ $project->id }}">
                            <span class="material-icons">delete</span> 
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
</div>

<!-- Modal for Adding New Project -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="customers" class="form-label">Select Customers</label>
                        <select id="customers" name="customers[]" class="form-select" multiple required>
                            @foreach($allCustomers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save Project</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Project -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProjectForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Use PUT for updating -->
                    <input type="hidden" id="editProjectId" name="id" >
                    <div class="mb-3">
                        <label for="editName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomers" class="form-label">Select Customers</label>
                        <select id="editCustomers" name="customers[]" class="form-select" multiple required>
                            @foreach($allCustomers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update Project</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Edit Project Button Click Event
        $('#editProjectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var projectId = button.data('id');
            var projectName = button.data('name');
            var projectDescription = button.data('description');
            var projectCustomers = button.data('customers').split(',');

            // Set the form values
            $('#editProjectId').val(projectId);
            $('#editName').val(projectName);
            $('#editDescription').val(projectDescription);

            // Set selected customers in the multi-select dropdown
            $('#editCustomers').val(projectCustomers);
        });

        // Handle Edit Form Submission
        $('#editProjectForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var projectId = $('#editProjectId').val();
            var url = '/projects/' + projectId; // Adjust the URL for the update route
            
            $.ajax({
                type: 'PUT',
                url: url,
                data: $(this).serialize(), // Send the form data
                success: function(response) {
                    // Handle success (e.g., reload the page or update the table)
                    location.reload(); // Reload the page to see changes
                },
                error: function(xhr) {
                    // Handle error
                    console.error(xhr);
                    alert('Failed to update project. Please try again.');
                }
            });
        });

        // Handle Project Deletion
        $('.delete-project').on('click', function() {
            var projectId = $(this).data('id');
            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    type: 'POST',
                    url: '/projects/' + projectId,
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}' // Include CSRF token for the delete request
                    },
                    success: function(response) {
                        // Reload the page to see changes
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to delete project. Please try again.');
                    }
                });
            }
        });
    });
</script>
@endsection
