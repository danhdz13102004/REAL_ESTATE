<template>
    <!-- <Price class="text-2xl" :price="listing.price"></Price> |
    <Price class="font-medium" :price="monthlyPayment"></Price> -->
     <br>
    <span class="">
       Beds:  <span class="text-sm font-bold">{{ listing.beds }}</span>
       - Baths:  <span class="text-sm font-bold">{{ listing.baths }}</span>
       - Area: <span class="text-sm font-bold">{{ listing.area }}</span> m2
    </span>
</template>


<script setup>
import { ref } from 'vue';
import { useMonthlyPayment } from '../Composables/useMonthlyPayment';
import Price from './Price.vue';


const props = defineProps({
    listing: Object
})

const rate = ref(2.5);
const year = ref(25);

console.log(props.listing.price);
const monthlyPayment = ref(useMonthlyPayment(props.listing.price,rate,year).monthlyPayment);
</script>
