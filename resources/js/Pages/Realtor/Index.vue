<template >
    <div class="mx-4">
        <h1>
            Your listings
        </h1>
        <section class="mb-4">
            <RealtorFilters :filters="filters"></RealtorFilters>
        </section>

        <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <Box  :class="{'dark:opacity-50 opacity-30' : listing.deleted_at}" class="cursor-pointer "  @click="view(listing)" v-for="listing in listings.data" :key="listing.id" >
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <span v-if="listing.sold_at" class="inline-block px-2 py-1 border border-dashed border-green-400 text-green-500 dark:border-green-600 dark:text-green-700 text-xs font-bold rounded-md mb-2">SOLD</span>
                        <div class="xl:flex xl:items-center gap-2 ">
                            <Price :price="listing.price"/>
                            <ListingSpace :listing="listing" ></ListingSpace>
                        </div>
                        <ListingAddress :listing="listing"></ListingAddress>
                    </div>
                    <div>
                        <div  class="flex items-center mt-2">
                            <button @click.stop.prevent="view(listing)" class="  text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 py-2 rounded-md">
                                Preview
                            </button>
                            <button @click.stop.prevent="edit(listing)" class="mx-2  text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 py-2 rounded-md">
                                Edit
                            </button>
                            <button v-if="!listing.deleted_at" @click.stop.prevent="destroy(listing)" class="  text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 py-2 rounded-md">
                                Delete
                            </button>
                            <button v-else @click.stop.prevent="restore(listing)" class="    text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 py-2 rounded-md">
                                Restore
                            </button>

                        </div>
                        <button @click.stop.prevent="editImage(listing)" class="py-2 text-center block w-full mt-2  text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 rounded-md">
                            Images ({{ listing.images_count }}) | Videos ({{ listing.videos_count }})
                        </button>
                        <button @click.stop.prevent="showOffer(listing)" class="py-2 text-center block w-full mt-2  text-gray-800 dark:text-white text-xs font-medium border-2 dark:border-white border-gray-800 px-2 rounded-md">
                            Offers ({{ listing.offers_count }})
                        </button>
                    </div>
                </div>
            </Box>         
        </section>

        <div v-else class="flex items-center border border-gray-300 rounded-md justify-center py-12">
            <span>No listings yet!</span>
        </div>

        <section v-if="listings.data.length" class="flex justify-center items-center mt-8">
            <Pagination :links="listings.links"></Pagination>
        </section>

    </div>

</template>


<script setup>
import { Link, router } from '@inertiajs/vue3';
import { route } from '../../../../vendor/tightenco/ziggy/dist';
import ListingAddress from '../../Components/ListingAddress.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import Price from '../../Components/Price.vue';


import Box from '../../Layouts/Box.vue';
import RealtorFilters from './RealtorFilters.vue';
import Pagination from '../Listing/Pagination.vue';


const props = defineProps({
    listings: Object,
    filters: Object
})

const view = (listing) => {
    router.get(route('listings.show',listing.id))
}

const edit = (listing) => {
    router.get(route('realtor.listings.edit',listing.id))
}

const destroy = (listing) => {
    router.delete(route('realtor.listings.destroy',listing.id));
}

const restore = (listing) => {
    router.patch(route('realtor.listings.restore',listing.id));
}


const editImage = (listing) => {
    router.get(route('realtor.listings.image.create',listing.id));
}

const showOffer = (listing) => {
    router.get(route('listings.offer.index',listing.id));
}


console.log(props.listings)

</script>
