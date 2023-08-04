@extends('layouts.app')

@section('content')
<section class="top-banner">
    <div class="container">
        <div class="heading-wrapper">
            <h1 class="heading">Welcome to Mozambique Atlas</h1>
            <form id="weather-form">
                @csrf
                <input type="text" name="city" class="input-rounded" placeholder="Search for the City" autofocus required>
                <div style="padding: 2%;">
                    <button type="submit">Search Now</button>
                </div>
            </form>
            <div class="error-message-container" id="error-container">
                <div class="error-message" id="error-message"></div>
            </div>
        </div>
    </div>
</section>
<section class="ajax-section">
    <div class="container" style="text-align: center;">
        <ul class="cities"></ul>
    </div>
</section>
@endsection