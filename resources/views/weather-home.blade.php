@push('styles')
    <style>

    </style>
@endpush

@include('layout.header')




@push('scripts')
    <script>
        const {
            createApp
        } = Vue;
        const element = document.getElementById("weather-app");
        const API_KEY = "{{ env('API_KEY') }}";
        
        const app = createApp({
            data() {
                return {

                };
            },
            methods: {
                getCurrentLocation() {
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
                getWeather(lat, lon) {
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
            mounted() {
                setInterval(() => {
                    this.getCurrentLocation();
                }, 10000);
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
