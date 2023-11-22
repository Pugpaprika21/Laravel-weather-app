@push('styles')
    <style>
        .weather-icon {
            width: 50px;
            height: 50px;
        }
    </style>
@endpush

@include('layout.header')

<x-navbar></x-navbar>

<div class="container">
    <div class="show-weather-list mt-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle tb-show-weather-list">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Points</th>
                    <th>Icon</th>
                </tr>
                <tr>
                    <td>Peter</td>
                    <td>Griffin</td>
                    <td>$100</td>
                    <td><img class="weather-icon" src="{{ asset('icon/cloud.png') }}" alt="" srcset=""></td>
                </tr>
                <tr>
                    <td>Lois</td>
                    <td>Griffin</td>
                    <td>$150</td>
                    <td><img class="weather-icon" src="{{ asset('icon/cloudy (2).png') }}" alt="" srcset="">
                    </td>
                </tr>
                <tr>
                    <td>Joe</td>
                    <td>Swanson</td>
                    <td>$300</td>
                    <td><img class="weather-icon" src="{{ asset('icon/rainy-day (1).png') }}" alt=""
                            srcset=""></td>
                </tr>
                <tr>
                    <td>Cleveland</td>
                    <td>Brown</td>
                    <td>$250</td>
                    <td><img class="weather-icon" src="{{ asset('icon/storm.png') }}" alt="" srcset="">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/WeatherHome.js') }}"></script>
@endpush

@include('layout.footer')
