<template>
    <div class="relative container mx-auto p-4 flex flex-no-wrap items-start z-10">
        <div class="shadow-lg flex flex-col-reverse sm:flex-row">
            <div class="w-full bg-white p-4">
                <div class="text-gray-700">
                    <h2>Let's get started <i class="material-icons float-right loading-spinner" v-if="this.loading">cached</i></h2>
                    <p class="mt-2 text-xs text-gray-base">Give me the details...</p>
                </div>

                <form @submit.prevent="searchFlights">
                    <div class="mt-3">
                        <span class="flex bg-gray-300 items-center px-3">
                            <i class="material-icons text-gray-400">airline_seat_recline_normal</i>
                            <select v-model="searchData.cabin" class="bg-gray-300 p-2 w-full" name="cabin">
                                <option selected value="ECONOMY">Economy Class</option>
                                <option value="BUSINESS">Business Class</option>
                                <option value="FIRST">First Class</option>
                            </select>
                        </span>

                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <i class="material-icons text-gray-400">people</i>
                            <select v-model="searchData.number_of_adults" class="bg-gray-300 p-2 w-full"
                                    name="number_of_adults">
                                <option selected value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                                <option value="5">5 Adults</option>
                                <option value="6">6 Adults</option>
                            </select>
                        </span>
                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <i class="material-icons text-gray-400">flight_takeoff</i>
                            <input v-model="searchData.origin" class="bg-gray-300 p-2 w-full" name="origin" placeholder="Origin"
                                   type="text">
                        </span>
                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <input v-model="searchData.departure" class="bg-gray-300 p-2 w-full" name="departure" placeholder="Departure"
                                   type="date">
                        </span>
                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <i class="material-icons text-gray-400">flight_land</i>
                            <input v-model="searchData.destination" class="bg-gray-300 p-2 w-full" name="destination"
                                   placeholder="Destination" type="text">
                        </span>
                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <input v-model="searchData.arrival" class="bg-gray-300 p-2 w-full" name="arrival" placeholder="Arrival"
                                   type="date">
                        </span>
                        <span class="flex bg-gray-300 items-center mt-2 px-3">
                            <i class="material-icons text-gray-400">flight_land</i>
                            <i class="material-icons text-gray-400">flight_takeoff</i>
                            <select v-model="searchData.layovers" class="bg-gray-300 p-2 w-full" name="layovers">
                                <option selected value="1">Allow layovers</option>
                                <option value="0">Don't allow layovers</option>
                            </select>
                        </span>

                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <button class="bg-blue-500 hover:bg-blue-400 px-4 py-2 text-white"><i class="material-icons">flight</i>
                            Find those Tickets!
                        </button>

                    </div>
                </form>

            </div>
        </div>
        <div class="flex flex-wrap items-start z-10">
            <offer :offer="offer" v-for="(offer, index) in offers" :key="index"></offer>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchData: {
                cabin: "ECONOMY",
                number_of_adults: 1,
                layovers: 1
            },
            offers: [],
            loading: false
        }
    },
    methods: {
        searchFlights() {
            this.loading = true;
            this.axios
                .post('/api/flights/search', this.searchData)
                .then(response => {
                    if (response.status === 404) {
                        this.offers = [];
                    } else {
                        this.offers = response.data.data
                    }
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false)
        }
    }
}
</script>
