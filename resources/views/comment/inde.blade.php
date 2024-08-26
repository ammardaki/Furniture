@extends('layouts.app')

@section('content')
 <link rel="stylesheet" type="text/css" href="css/commentind.css">
    <style>
      
    </style>

    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row" id="furniture-cards">
                    <!-- Cards will be appended here dynamically -->
                    <div class="bottom-buttons d-flex justify-content-center">
                        <h1>Comment</h1>
                    </div>
                </div>
                <br>
            </div>
        </div>

  
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row" id="furniture-cards">
                        <!-- Cards will be appended here dynamically -->
                        <div class="bottom-buttons d-flex justify-content-center">
                            <h1>Evaluation</h1>

                        </div>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row" id="ads-cards">
                <!-- سيتم هنا عرض الإعلانات المضافة -->
            </div>
        </div>

        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                // استرداد بيانات التعليقات

                <?php $comments = \App\Models\Comment::all(); ?>
                <?php foreach ($comments as $item): ?>
                var card = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                        
                            <h5 class="card-title">Body: <?php echo $item->body; ?></h5>
                            <p class="card-text">Furniture ID: <?php echo $item->furniture_id; ?></p>
                            <p class="card-text">User ID: <?php echo $item->user_id; ?></p>
                        </div>
                    </div>
                </div>
            `;
                $('#furniture-cards').append(card);
                <?php endforeach; ?>

                // استرداد بيانات التقييمات
                <?php $evaluation = \App\Models\Evaluation::all(); ?>
                <?php foreach ($evaluation as $eva): ?>
                var adCard = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User ID: <?php echo $eva->user_id; ?></h5>
                            <p class="card-text">Furniture ID: <?php echo $eva->furniture_id; ?></p>
                            <p class="card-text">Value: <?php echo $eva->value; ?></p>

                        </div>
                    </div>
                </div>
            `;
                $('#ads-cards').append(adCard);
                <?php endforeach; ?>

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
