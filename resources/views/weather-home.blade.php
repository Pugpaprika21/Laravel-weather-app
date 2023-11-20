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
        const API_URL_WEATHER = "{{ env('API_URL_WEATHER') }}";

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
                    axios.get(`http://api.openweathermap.org/geo/1.0/direct?q=${currentCountry}&limit=${limit}&appid=${API_KEY}`)
                        .then(res => {
                            console.log(res)
                        })
                        .catch(err => {
                            console.error(err);
                        });
                },
            },
            mounted() {
                //setInterval(() => {
                    this.getCurrentLocation();
                //}, 5000);
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
