<template>
    <div>





        <p class="text-sm font-hairline text-gray-600 mt-2 text-center">
            <span v-for="(segment, index) in itinerary.segments" :key="index" v-if="(index === 1 && segment.carrier !== itinerary.segments[index - 1].carrier) || (index === 2 && segment.carrier !== itinerary.segments[index - 1].carrier) || (index === 3 && segment.carrier !== itinerary.segments[index - 1].carrier) || itinerary.segments.length === 1">
                    {{ segment.carrier[Object.keys(segment.carrier)[0]]
                }}<br>
            </span>
        </p>
        <p class="text-gray-700 font-bold text-center">{{ itinerary.duration }}
        </p>
        <div class="flex justify-between text-center">
            <div>
                <p class="text-gray-500">
                    <i class="material-icons">flight_takeoff</i>
                </p>
                <p class="text-xs mt-2 text-gray-600 font-hairline">{{ itinerary.segments[0].departure.airport }}</p>
                <p class="text-xs mt-2 text-gray-600 font-hairline">{{
                        itinerary.segments[0].departure.time
                    }}</p>
            </div>
            <div>
                <p class="text-xs font-bold mt-2 px-3 bg-blue-700 text-white rounded-full">
                    <span v-if="itinerary.segments.length - 1 > 0">
                        {{ itinerary.segments.length - 1 }} stop<span v-if="itinerary.segments.length - 1 > 1">s</span>
                    </span>
                    <span v-else>
                        direct
                    </span>
                </p>
            </div>
            <div>
                <p class="text-gray-500">
                    <i class="material-icons">flight_land</i>
                </p>
                <p class="text-xs mt-2 text-gray-600 font-hairline">{{ itinerary.segments[itinerary.segments.length - 1].arrival.airport }}</p>
                <p class="text-xs mt-2 text-gray-600 font-hairline">{{
                        itinerary.segments[itinerary.segments.length - 1].arrival.time
                    }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Itinerary",
    props: ["itinerary"],
    itinerary: {},
    created() {
        console.log(this.itinerary);
    }
}
</script>

<style scoped>

</style>
