<template>
    <div v-if="typeof item !== 'undefined' && item !== null">
        <strong>{{ item.iataCode }}</strong>
        <span>{{ item.name }}</span>
    </div>
</template>

<script>
export default {
    name: "AirportTemplate",
    props: {
        item: { required: true }
    },
    // data() {
    //     return {
    //         // airport: {}
    //     };
    // },
    created() {
        console.log('airport:');
        console.log(this.airport);
    }
}
</script>
