<template>
    <Box>
        <template #header>Make an offer</template>
        
        <div>
            <input v-model.number="form.amount" class="w-full py-1 mt-2 text-black px-1" type="number" name="" id="" >
        </div>
        <span v-if="page.props.flash.validate?.amount" class="text-red-600 font-bold">
            {{ page.props.flash.validate?.amount[0] }}
        </span>
        <input v-model.number="form.amount" type="range" :min="min" :max="max" step="1000"
          class="mt-4 w-full h-2  bg-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-100"
          >
        <button @click="makeOffer" class="mt-2 btn-primary w-full">Offer</button>  
        <div class="mt-4 flex justify-between">
            <span>Difference</span>
            <span>{{props.listing.price - form.amount  }}$</span>
        </div>
    </Box>
</template>

<script setup>
import { computed, watch } from "vue";
import Box from "../../../Layouts/Box.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/dist";
import { debounce } from "lodash";

const page = usePage();


const props = defineProps({
    listing: Object
});

const form = useForm({
    amount: props.listing.price ,
    listing_id: props.listing.id
});



const min = computed( () => {
    return parseInt(props.listing.price / 2);
}) 

const max = computed( () => {
    return parseInt(props.listing.price * 2);
}) 

const makeOffer = () => {
    router.post(route('zalopayment.store'),form);
}



const emit = defineEmits(['inFocus', 'submit'])


watch(
  () => form.amount, 
  debounce((value) => {
    emit('offerUpdated', value);
  }, 200),
)

</script>