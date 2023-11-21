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
    <script>
        const {
            createApp
        } = Vue;
        const element = document.getElementById("weather-app");
        const API_KEY = "{{ env('API_KEY') }}";

        const app = createApp({
            data: function() {
                return {

                };
            },
            methods: {
                getCurrentLocation: function() {
                    console.log("is run..");

                    let currentCountry = "Bangkok,TH";
                    let limit = 5;
                    axios.get(
                            `http://api.openweathermap.org/geo/1.0/direct?q=${currentCountry}&limit=${limit}&appid=${API_KEY}`
                        )
                        .then(res => {
                            if (res.status == 200) {
                                this.getWeather(res.data[0].lat, res.data[0].lon);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                        });
                },
                getWeather: function(lat, lon) {
                    axios.get(
                            `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${API_KEY}`
                        )
                        .then(res => {
                            if (res.status == 200) {
                                console.log(res.data[0])
                            }
                        })
                        .catch(err => {
                            console.error(err);
                        });
                }
            },
            mounted: function() {
                // setInterval(() => {
                //     this.getCurrentLocation();
                // }, 10000);
            },
        });

        if (element) {
            app.mount("#" + element.id);
        } else {
            console.log("script not run in .. {{ url()->current() }}");
        }
    </script>
@endpush

@include('layout.footer')
