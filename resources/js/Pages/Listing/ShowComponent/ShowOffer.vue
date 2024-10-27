<template>
    <Box>
        <template #header>Offer Made</template>
        <Price class="text-2xl" :price="props.offer.amount"></Price> 
        <div class="flex items-center justify-between">
            <span>Made on</span>
            <span>{{ offerAmount }}</span>
        </div>
    </Box>    
</template>


<script setup>
import { computed } from 'vue';
import Box from '../../../Layouts/Box.vue';
import Price from '../../../Components/Price.vue';


const props = defineProps({
    offer: Object
})
const offerAmount = computed(() => {
    console.log('amount',props.offer.created_at);
    const date = new Date(props.offer.created_at);
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
})

</script>