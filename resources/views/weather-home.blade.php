@push('styles')
    <style>
        [aria-current] .page-link {
            background-color: rgb(232, 165, 41); !important;
        }
        [rel='prev'],
        [rel='next'] {
            background-color: #ffffff !important;
        }
        .pagination>li :not([rel='prev'], [rel='next'], [aria-current] .page-link) {
            background-color: rgb(255, 255, 255) !important;
        }
    </style>
@endpush

@include('layout.header')

<x-navbar></x-navbar>

<div class="container">
    <div class="show-weather-list mt-4">
        <form class="row g-3 needs-validation mb-3" novalidate>
            <div class="col-md-6">
                <label for="search_weather" class="form-label">WeatherMain</label>
                <select class="form-select" id="search_weather" v-model="searchWeather">
                    <option value="">Choose...</option>
                    @foreach ($rsqWeatherSelected as $weatherSelected)
                        <option value="{{ $weatherSelected->id }}">{{ $weatherSelected->weather_main }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="limit_weather" class="form-label">Limit Rows</label>
                <select class="form-select" id="limit_weather" v-model="limitWeather">
                    <option value="">Choose...</option>
                    @for ($i = 0; $i < 10; $i++)
                        <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-grid">
                    <label for="" class="form-label">Search</label>
                    <button class="btn" type="button" style="background-color: rgb(232, 165, 41); color: white;" @click="submitfilterWhereWeather()">Search</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle tb-show-weather-list">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>lat</td>
                        <td>lon</td>
                        <td>weather</td>
                        <td>description</td>
                        <td>country</td>
                        <td>city name</td>
                        <td>icon</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rsqWeathers as $index => $weather)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $weather->lat }}</td>
                            <td>{{ $weather->lon }}</td>
                            <td>{{ $weather->weather_main }}</td>
                            <td>{{ $weather->weather_description }}</td>
                            <td>{{ $weather->sys_country }}</td>
                            <td>{{ $weather->city_name }}</td>
                            <td><img @style(['width: 30px;', 'height: 30px;']) src="{{ asset('icon/' . $weather->weather_main . '.png') }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="weather-pagination pagination justify-content-end">
            {{ $rsqWeathers->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/WeatherHome.js') }}"></script>
@endpush

@include('layout.footer')
