<template>
    <Transition name="fade">
        <div v-if="showing" class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 z-30">
            <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 relative flex justify-between">
                <button
                    aria-label="close"
                    class="absolute top-0.5 right-0.5 text-xl text-gray-500 my-2 mx-4"
                    @click.prevent="close"
                >
                    ×
                </button>

                <div v-for="(itinerary, index) in offer.itineraries" :key="index" class="itinerary lg:w-64 lg:w-100 p-2">
                    <div class="text-center">
                        <span v-if="index == 0">Outbound</span>
                        <span v-else>Inbound</span>
                    </div>
                    <div v-for="(segment, index) in itinerary.segments" :key="index" class="segment">
                        <p class="text-sm w-full font-hairline text-gray-600 mt-2 text-center">
                            {{ segment.carrier[Object.keys(segment.carrier)[0]] }}
                        </p>
                        <div class="flex justify-between text-center">
                            <div>
                                <p class="text-gray-500">
                                <span class="has-tooltip">
                                    <span class="tooltip rounded shadow-lg p-1 bg-gray-100 text-blue-700 -mt-8">{{ segment.aircraft }}</span>
                                    <i class="material-icons">flight_takeoff</i>
                                </span>
                                </p>
                                <p class="text-xs mt-2 text-gray-600 font-hairline">{{ segment.departure.airport }}</p>
                                <p class="text-xs mt-2 text-gray-600 font-hairline">{{
                                        segment.departure.time
                                    }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold mt-2 px-3 bg-blue-700 text-white rounded-full">
                                    <span>
                                        {{ segment.duration }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-500">
                                <span class="has-tooltip">
                                    <span class="tooltip rounded shadow-lg p-1 bg-gray-100 text-blue-700 -mt-8">{{ segment.aircraft }}</span>
                                    <i class="material-icons">flight_land</i>

                                </span>
                                </p>
                                <p class="text-xs mt-2 text-gray-600 font-hairline">{{ segment.arrival.airport }}</p>
                                <p class="text-xs mt-2 text-gray-600 font-hairline">{{
                                        segment.arrival.time
                                    }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    name: "OfferModal",
    props: {
        showing: {
            required: true,
            type: Boolean
        },
        offer: {
            required: true
        }
    },
    watch: {
        showing(value) {
            if (value) {
                return document.querySelector('body').classList.add('overflow-hidden');
            }

            document.querySelector('body').classList.remove('overflow-hidden');
        }
    },
    methods: {
        close() {
            this.$emit('close');
        }
    }
}
</script>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: all 0.4s;
    }
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>
