<template>
    <div class="bg-white shadow p-4 rounded lg:w-64 ml-2 mt-2">
        <div class="text-center mt-4">
            <p class="text-gray-600 font-bold">&euro; {{ offer.price.total }}</p>
        </div>
        <itinerary v-for="(itinerary, index) in offer.itineraries" :key="index" :itinerary="itinerary"></itinerary>
        <div class="mt-6">
            <button @click="openOffer"
                class="rounded shadow-md w-full items-center shadow bg-blue-500 px-4 py-2 text-white hover:bg-blue-400">
                Show offer <span v-if="offer.available_seats < 10" class="sm:text-sm">({{ offer.available_seats }} left)</span>
            </button>
        </div>
    </div>
</template>

<script>
import Itinerary from "./Itinerary";
export default {
    name: "Offer",
    components: {Itinerary},
    props: ["offer"],
    offer: {},
    created() {
    },
    methods: {
        openOffer() {
            this.$emit('offer-modal-hide', this.offer);
        }
    }
}
</script>

<style scoped>

</style>
