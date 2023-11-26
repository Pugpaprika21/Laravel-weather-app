const { createApp } = Vue;
const element = document.getElementById("weather-app");

const app = createApp({
    name: "WeatherHome",
    data: function() {
        return {
            url: {
                app: "http://127.0.0.1:8000/weather/api/",
            },
            input: {
                filterCurrentCountry: "Bangkok,TH",
                filterLimitData: 5,
            },
            request: true,
        };
    },
    methods: {
        getCurrentLocation: function(keyApi) {
            let currentCountry = "Bangkok,TH";
            let limit = 5;

            if (this.request) {
                axios
                    .get(
                        `http://api.openweathermap.org/geo/1.0/direct?q=${currentCountry}&limit=${limit}&appid=${keyApi}`
                    )
                    .then((res) => {
                        if (res.status == 200) {
                            this.getWeather(
                                res.data[0].lat,
                                res.data[0].lon,
                                keyApi
                            );
                        }
                    })
                    .catch((err) => {
                        if (err.response.data.cod == 401) {
                            this.request = false;
                            console.log("401 (Unauthorized)");
                        }
                    });
            }
        },
        getWeather: function(lat, lon, keyApi) {
            axios
                .get(
                    `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${keyApi}`
                )
                .then((res) => {
                    if (res.status == 200) {
                        this.saveWeather(res.data);
                    }
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        saveWeather: function(weatherObj) {
            axios
                .post(
                    this.url.app + "save-weather",
                    (params = {
                        data: weatherObj,
                    })
                )
                .then((res) => {
                    if (res.status == 200) {
                        console.log(res.data.Data.Message);
                    }
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        showWeathers() {
            axios
                .get(this.url.app + "show-weathers")
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        loadWeatherEnvironment: function() {
            if (this.request) {
                axios
                    .get(this.url.app + "load-weather-environment")
                    .then((res) => {
                        if (res.status == 200) {
                            this.getCurrentLocation(res.data.data.api);
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
    },
    mounted: function() {
        this.showWeathers();
        // setInterval(() => {
        //     this.loadWeatherEnvironment();
        // }, 3000);
    },
});

if (element) {
    app.mount("#" + element.id);
} else {
    console.log("components 'WeatherHome' not run..");
}