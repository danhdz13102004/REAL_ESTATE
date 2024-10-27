<template>
    <div class="border-b py-2">
        <!-- <template #header>Offer #{{ offer.id }}</template> -->
        <span class="font-medium text-gray-400">Offer #{{ offer.id }}</span>
        <span v-if="offer.accepted_at" class="bg-green-800 text-white p-1 rounded-md uppercase ml-2 font-medium">ACCEPTED</span>
        <div class="flex items-center justify-between">
            <div>
                <Price class="text-xl" :price="offer.amount"></Price>
                 <br>
                <span>Difference <Price class="text-lg" :price="offer.amount - listing.price"></Price></span> <br>
                <span>Made by {{ offer.user.name }}</span> <br>
                <span>Made on {{ offerDay }}</span>
            </div>
            <button v-if="notSold" @click="Accept(offer.id)" class="mr-4 px-4 py-2 dark:bg-green-600  bg-green-700 text-xl font-medium rounded-md hover:opacity-70">Accept</button>
        </div>
    </div>    
</template>

<script setup>
import { computed } from 'vue';
import Price from '../../../Components/Price.vue';
import Box from '../../../Layouts/Box.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/dist';
import { router } from '@inertiajs/vue3';
const props = defineProps({
    offer: Object,
    listing: Object
});

const offerDay = computed(() => {
    console.log('amount',props.offer.created_at);
    const date = new Date(props.offer.created_at);
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
})

const Accept = (id) => {
    router.patch(route('listings.offer.update',{listing: props.listing.id, offer: id }))
}

const notSold = computed(() => {
    return !props.listing.sold_at;
})

</script>
