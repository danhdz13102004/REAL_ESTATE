<template>
    <div class="px-8 py-4">
        <Link :href="route('realtor.listings.index')" class="flex items-center" >
            <svg class="dark:text-white fill-red-500   dark:bg-white" style="width: 20px;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

            <span class="ml-2"> Go back to Listings</span>
        </Link>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <Box  class="col-span-8">
                <div v-for="offer in offers" :key="offer.id">
                <OfferBox :listing="listing" :offer="offer">

                </OfferBox>
                
                </div>

            </Box>


            <Box class="col-span-4">
                <template #header>Basic Infor</template>
                <Price class="text-2xl" :price="listing.price"></Price> 
                <ListingSpace  :listing="listing"></ListingSpace> <br>
                <ListingAddress :listing="listing"></ListingAddress> <br>
            </Box>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { route } from '../../../../vendor/tightenco/ziggy/dist';
import Box from '../../Layouts/Box.vue';
import Price from '../../Components/Price.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import OfferBox from './OfferComponent/OfferBox.vue';

 
const props = defineProps({
    listing: Object,
    offers: Array
}) ;

</script>
