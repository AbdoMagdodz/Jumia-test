<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Loader CSS -->
    <link rel="stylesheet" href="{{asset('css/loader.css')}}">
    <style>
        body {
            background-color: #F6F9FE !important;
        }
    </style>
    <title>Jumia Assessment Test</title>
</head>
<body>
<div class="container mt-3">
    <div id="loader-container">
        <div class="loader">Loading...</div>
    </div>

    <!-- Header section -->
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Phone Numbers</h1>
        </div>
    </div>
    <!-- Filters section -->
    <form id="filter-phones-form">
        <div class="row mb-4">
            <div class="col-md-3">
                <select id="select-country" name="phone_country_code" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->code}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="select-valid-phones" name="state" class="form-control">
                    <option value="">All Phone Numbers</option>
                    <option value="OK">Valid Phone Numbers</option>
                    <option value="NOK">Invalid Phone Numbers</option>
                </select>
            </div>
        </div>
    </form>
    <!-- Phone numbers table section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div id="phone-number-table" class="table-responsive"></div>
        </div>
    </div>
    <!-- Pagination buttons section -->
    <div class="row mb-4">
        <div class="col-md-2 offset-md-8">
            <button id="paginate-back" class="btn btn-secondary btn-block">Back</button>
        </div>
        <div class="col-md-2">
            <button id="paginate-next" class="btn btn-secondary btn-block">Next</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    let currentPage = 1;
    let lastPage = currentPage;
    let query = '';

    $('#select-country, #select-valid-phones').change(function () {
        $('#filter-phones-form').submit();
    });

    $('#paginate-next').click(() => {
        if (currentPage === lastPage) return;
        currentPage++;
        listCustomerPhones();
    });

    $('#paginate-back').click(() => {
        if (currentPage === 1) return;
        currentPage--;
        listCustomerPhones();
    });

    $('#filter-phones-form').on('submit', function (e) {
        e.preventDefault();
        currentPage = 1;
        lastPage = 1;
        query = $(this).serialize();
        listCustomerPhones();
    });

    function listCustomerPhones() {
        if (currentPage > lastPage) return;
        $.get(`{{route('ajax_list_phones')}}?page=${currentPage}&${query}`, res => {
            lastPage = res.last_page;
            $('#phone-number-table').html(res.body);
        });
    }

    window.addEventListener('load', function () {
        listCustomerPhones();
        $('#loader-container').hide();
    })
</script>
</body>
</html>