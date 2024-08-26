@extends('layouts.app')


<div class="row justify-content-center">


    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Furniture Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <img src="{{ $furniture->img_url }}" alt="Furniture Image" class="furniture-image">
                </div>
            </div>
            <div class="col-md-6">
                <div class='textstyle'>
                    <h5><strong>ID :</strong> {{ $furniture->id }}</h5>
                    <br>
                    <h5><strong>Name :</strong> {{ $furniture->furniture_name }}</h5>
                                        <br>
                    <h5><strong>Quantity :</strong> {{ $furniture->quantity }}</h5>
                </div>
            </div>
        </div>
    </div>



    

</div>


<style>
    .furniture-image {
        width: 100%;
        /* Adjusted width for the image */
        height: auto;
        margin-bottom: 10px;
        /* Optional: Add margin bottom to separate image from text */
    }

    .textstyle {
        text-align: center;
        /* Align text to the right */
        margin-right: 350px;
        /* Adjust as needed for your layout */
        margin-top: 100px;
        /* Add margin to move text downwards */
    }

    .button-row {
        display: flex;
        justify-content: space-between;
        /* Align buttons with space between them */
        margin-bottom: 20px;
        /* Optional: Add margin bottom for spacing */
        margin-top: 150px;
    }

    .button-container {
        /*  flex: 1; /* Allow buttons to take up equal space */
        margin-right: 40px;
        /* Optional: Add margin between buttons */
        margin-left: 20px;
        **/ margin-top: 80px;
    }

    .btn {
        /*  flex: 1; /* Allow buttons to take up full width */
        margin-right: 40px;
        /* Optional: Add margin between buttons */
        margin-left: 20px;
        **/ margin-top: 80px;
    }
</style>
