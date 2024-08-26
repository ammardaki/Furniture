@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="homeadmin.css">

    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <form class="form-inline" method="GET" action="{{ route('search.furniture') }}">
                    <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>
                </form>
                <h3 class="card-title">Aldaki Furniture</h3>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light ml-3">Logout</button>
                </form>
            </div>
            <div class="card-body">
                <div class="row" id="furniture-cards">
                    <!-- Cards will be appended here dynamically -->
                    <div class="bottom-buttons">
                        <a href="#furnitureForm" class="btn btn-success scroll-to">Add Furniture</a>
                        <a href="#adForm" class="btn btn-info scroll-to">Add AD</a>
                        <a href="{{ route('ads.index') }}" class="btn btn-info">View Ads</a>

                    </div>
                </div>
                <br>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <!-- قسم إضافة الأثاث -->
                <div class="col-md-6" id="furnitureForm">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h2 class="card-title">New Furniture</h2>
                            <form action="{{ route('furnitures.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group custom-form-group">
                                    <label for="furniture_name">Furniture Name</label>
                                    <input type="text" name="furniture_name" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group custom-form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group custom-form-group">
                                    <label for="image">Image URL</label>
                                    <input type="text" id="img_url" name="img_url" class="form-control"
                                        value="{{ old('img_url') }}" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- قسم إضافة الإعلان -->
                <div class="col-md-6" id="adForm">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h2 class="card-title">Add New Ad</h2>
                            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group custom-form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group custom-form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group custom-form-group">
                                    <label for="image_url">Image URL</label>
                                    <input type="text" name="image_url" id="image_url" class="form-control"
                                        value="{{ old('image_url') }}" required>
                                    @error('image_url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- زر Feedback في الأسفل -->
                <div class="feedback-button text-center mt-4">
                    <a href="{{ route('comment.inde') }}" class="btn btn-primary">Feedback</a>
                    <a href="{{ route('booking.adindex') }}" class="btn btn-info">View Books</a>


                </div>





                <!-- مودال تأكيد الحذف -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this furniture item?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var furnitureIdToDelete; // تخزين معرف الأثاث المراد حذفه

                        // استرداد بيانات الأثاث
                        <?php $furnitur = \App\Models\Furniture::all(); ?>
                        <?php foreach ($furnitur as $item): ?>
                        var card = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $item->img_url; ?>" alt="Furniture Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item->furniture_name; ?></h5>
                            <p class="card-text">Quantity: <?php echo $item->quantity; ?></p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary view-details" data-id="<?php echo $item->id; ?>">View Details</a>
                                <button class="btn btn-danger delete-furniture" data-id="<?php echo $item->id; ?>" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                        $('#furniture-cards').append(card);
                        <?php endforeach; ?>

                        // انقر على زر "View Details" لعرض بيانات البطاقة
                        $(document).on('click', '.view-details', function(e) {
                            e.preventDefault();
                            var furniturId = $(this).data('id');
                            window.location.href = '/furnitur/' + furniturId;
                        });

                        // تخزين معرف الأثاث في المتغير عند النقر على زر الحذف
                        $(document).on('click', '.delete-furniture', function() {
                            furnitureIdToDelete = $(this).data('id');
                        });

                        // تنفيذ عملية الحذف عند التأكيد
                        $('#confirmDelete').click(function() {
                            $.ajax({
                                url: '/furnitur/' + furnitureIdToDelete,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(result) {
                                    alert('Furniture deleted successfully.');
                                    $('#deleteConfirmationModal').modal('hide');
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    alert('Error deleting furniture. Please try again later.');
                                    $('#deleteConfirmationModal').modal('hide');
                                }
                            });
                        });

                        // تمرير تلقائي إلى القسم المطلوب عند النقر على الزر المناسب
                        $('.scroll-to').on('click', function(event) {
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: $($.attr(this, 'href')).offset().top
                            }, 500);
                        });
                    });
                </script>
            @endsection
