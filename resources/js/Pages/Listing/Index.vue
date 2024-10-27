<template>
    <Filter :filters="filters"></Filter>
    <div  class="mt-4 mx-5 grid grid-cols-12  gap-3 ">


    <Box @click="router.get(route('listings.show',listing.id))" class="col-span-6  lg:col-span-4 hover:bg-indigo-600 hover:text-white cursor-pointer" v-for="listing in listings.data" :key="listing.id">
        <div>
            <Price class="text-2xl" :price="listing.price"></Price> |
            <MonthlyPayment :listing="listing"></MonthlyPayment>
            <ListingSpace  :listing="listing"></ListingSpace> <br>
            <ListingAddress :listing="listing"></ListingAddress> <br>
        </div>
    </Box>

    </div>
    <div class="flex justify-center mt-8 ">
        <Pagination :links="listings.links" />
    </div>
</template>


<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import ListingAddress from '../../Components/ListingAddress.vue';
import { route } from '../../../../vendor/tightenco/ziggy/dist';
import Box from '../../Layouts/Box.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import { useToast } from 'vue-toastification';
import { computed } from 'vue';
import Pagination from './Pagination.vue';
import Filter from './IndexComponent/Filter.vue';
import Price from '../../Components/Price.vue';
import MonthlyPayment from '../../Components/MonthlyPayment.vue';

const view = () => {

}

const props =  defineProps({
    listings: Object,
    filters: Object
})


// props.toast('hehe');

</script>
