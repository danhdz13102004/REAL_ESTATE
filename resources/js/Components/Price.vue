<template>
    <span class=" font-bold">{{formattedPrice}}</span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    price: [Number, String]
})

const formattedPrice = computed( 
    () => props.price.toLocaleString('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits:0 })
)

</script>