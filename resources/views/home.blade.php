@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="css/home.css">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <form class="form-inline" method="GET" action="{{ route('search.furniture') }}">
                        <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <h3 class="card-title">Aldaki Furniture</h3>
                </div>
                <!-- زر تسجيل الخروج -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-3">
                    @csrf
                    <button type="submit" class="btn btn-light">Logout</button>
                </form>
            </div>
            <div class="card-body">
                <!-- قسم المفروشات -->
                <h3>Furniture</h3>
                <div class="row" id="furniture-cards">
                    <!-- Cards will be appended here dynamically -->
                </div>

                <!-- قسم الإعلانات -->
                <h3>Ads</h3>
                <div class="row" id="ads-cards">
                    <!-- Cards will be appended here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- زر Feedback في الأسفل -->
<div class="feedback-button text-center mt-4">
    <a href="{{ route('comment.index') }}" class="btn btn-primary">Feedback</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // استرداد بيانات الأثاث
        <?php $furniture = \App\Models\Furniture::all(); ?>
        <?php foreach ($furniture as $item): ?>
        var card =
            '<div class="col-md-4 mb-4"><div class="card"><img class="card-img-top" src="<?php echo $item->img_url; ?>" alt="Card image cap"><div class="card-body"><h5 class="card-title">' +
            '<?php echo $item->furniture_name; ?>' + '</h5><p class="card-text">Quantity: ' +
            '<?php echo $item->quantity; ?>' + '</p><a href="#" class="btn btn-primary view-details" data-id="' +
            '<?php echo $item->id; ?>">View Details</a></div></div></div>';
        $('#furniture-cards').append(card);
        <?php endforeach; ?>

        // استرداد بيانات الإعلانات
        <?php $ads = \App\Models\Ad::all(); ?>
        <?php foreach ($ads as $ad): ?>
        var adCard =
            '<div class="col-md-4 mb-4"><div class="card"><img class="card-img-top" src="<?php echo $ad->image_url; ?>" alt="Card image cap"><div class="card-body"><h5 class="card-title">' +
            '<?php echo $ad->title; ?>' + '</h5><p class="card-text">Description: ' +
            '<?php echo $ad->description; ?>' + '</p><a href="#" class="btn btn-primary view-ad-details" data-id="' +
            '<?php echo $ad->id; ?>">View Details</a></div></div></div>';
        $('#ads-cards').append(adCard);
        <?php endforeach; ?>

        // انقر على زر "View Details" لعرض بيانات الأثاث
        $(document).on('click', '.view-details', function(e) {
            e.preventDefault();
            var furnitureId = $(this).data('id');
            // توجيه المستخدم إلى المسار الجديد لعرض بيانات العنصر
            window.location.href = '/furniture/' + furnitureId;
        });

        // انقر على زر "View Details" لعرض بيانات الإعلانات
        $(document).on('click', '.view-ad-details', function(e) {
            e.preventDefault();
            var adId = $(this).data('id');
            // توجيه المستخدم إلى المسار الجديد لعرض بيانات الإعلان
            window.location.href = '/ads/' + adId;
        });
    });
</script>
