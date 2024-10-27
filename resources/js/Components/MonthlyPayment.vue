<template>

    <Price class="font-medium" :price="monthlyPayment"></Price>
  
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
