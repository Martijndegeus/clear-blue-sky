<template>
    <div>
        <strong>{{ airport.iataCode }}</strong>
        <span>{{ airport.name }}</span>
    </div>
</template>

<script>
export default {
    name: "AirportTemplate",
    props: {
        airport: {required: true}
    },
    data() {
        return {
            airport: {}
        };
    },
    created() {
        console.log(this.airport);
    }
}
</script>
