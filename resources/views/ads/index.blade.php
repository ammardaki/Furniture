@extends('layouts.app')

@section('content')
    <!-- Custom styles for the card component -->
    <link rel="stylesheet" type="text/css" href="css/adindex.css">

    <div class="container mt-4">
        <!-- Page Title -->
        <div class="page-title">Ads</div>

        <div class="row" id="ads-cards">
            @foreach ($ads as $ad)
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card custom-card">
                        <!-- Link to view ad image in a new tab -->
                        <a href="{{ $ad->image_url }}" target="_blank">
                            <img class="card-img-top" src="{{ $ad->image_url }}" alt="Ad Image">
                        </a>
                        <div class="card-body">
                            <!-- Display ad title -->
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <!-- Display ad description -->
                            <p class="card-text">{{ $ad->description }}</p>
                            <!-- Buttons in a row -->
                            <div class="button-row">
                                <a href="/ads/{{ $ad->id }}" class="btn view-details" data-id="{{ $ad->id }}">View Details</a>
                                <button class="btn delete-Ad" data-id="{{ $ad->id }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Modal title -->
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Confirmation message -->
                    Are you sure you want to delete this ad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and AOS (Animate on Scroll) libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- Custom JavaScript for handling delete functionality -->
    <script>
        $(document).ready(function() {
            var adIdToDelete; // Variable to store the ID of the ad to be deleted
            
            // Store the ad ID when the delete button is clicked
            $(document).on('click', '.delete-Ad', function() {
                adIdToDelete = $(this).data('id');
            });
            
            // Handle the delete confirmation
            $('#confirmDelete').click(function() {
                $.ajax({
                    url: '/ad/' + adIdToDelete, // URL for delete request
                    type: 'DELETE', // HTTP method for delete
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(result) {
                        alert('Ad deleted successfully.');
                        $('#deleteConfirmationModal').modal('hide'); // Hide the modal on success
                        window.location.reload(); // Reload the page to reflect changes
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting ad. Please try again later.');
                        $('#deleteConfirmationModal').modal('hide'); // Hide the modal on error
                    }
                });
            });

            // Initialize AOS (Animate on Scroll)
            AOS.init();
        });
    </script>
@endsection
