<template>
    <form @submit.prevent="filter"  class="flex gap-4">
        <div class="flex">
            <input v-model.number="filterForm.priceFrom" placeholder="Price from" class="px-8 py-4 input-filter" >
            <input v-model.number="filterForm.priceTo" placeholder="Price to" class="px-8 py-4 pr-2 input-filter-r ">
        </div>
        <div class="flex ">
            <select v-model="filterForm.beds" class="bg-gray-300 dark:bg-gray-300 text-gray-900 dark:text-gray-900  w-24 ">
                <option value="null">Beds</option>
                <option v-for="i in 5" :key="i" :value="i" >{{ i }}</option>
                <option value="6+">6+</option>
            </select>
            <select v-model="filterForm.baths" class="bg-gray-100 dark:bg-white text-gray-800 dark:text-gray-900  w-24">
                <option value="null">Baths</option>
                <option v-for="i in 5" :key="i" :value="i" >{{ i }}</option>
                <option value="6">6+</option>
            </select>
        </div>
        <div class="flex">
            <input v-model.number="filterForm.areaFrom"  placeholder="Area from" class="px-8 py-4 input-filter">
            <input v-model.number="filterForm.areaTo" placeholder="Area to" class="px-8 py-4 pr-2 input-filter-r">
        </div>
        <div>
            <input v-model.number="filterForm.street" placeholder="Street" class="px-8 py-4 input-filter" >
            <input v-model.number="filterForm.city" placeholder="City" class="px-8 py-4 pr-2 input-filter-r ">
        </div>

        <div class="flex gap-2 items-center">
            <button type="submit" class="btn-primary">Filter</button>
            <button @click="clear"  class="btn-primary">Clear</button>
        </div>
    </form>
</template>


<script setup>
import { useForm } from '@inertiajs/vue3';
import { route } from '../../../../../vendor/tightenco/ziggy/dist';


const props = defineProps({
    filters: Object
})

const filterForm = useForm({
    priceFrom: props.filters?.priceFrom ?? null,
    priceTo: props.filters?.priceTo ?? null,
    beds: props.filters?.beds ?? null,
    baths: props.filters?.baths ?? null,
    areaFrom: props.filters?.areaFrom ?? null,
    areaTo: props.filters?.areaTo ?? null,
    street: props.filters?.street ?? null,
    city: props.filters?.city ?? null
})  

const filter = () => {
    filterForm.get(route('listings.index'));
}

const clear = () => {
    filterForm.priceFrom = null;
    filterForm.priceTo = null;
    filterForm.beds = null;
    filterForm.baths = null;
    filterForm.areaFrom = null;
    filterForm.areaTo = null;
    filterForm.street = null;
    filterForm.city = null;
    filter();
}


</script>