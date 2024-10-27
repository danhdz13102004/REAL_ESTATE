<template>
  <div class="p-2 flex flex-col md:grid md:grid-cols-12 gap-4 px-4">
    <div class="col-span-8 border rounded-md   border-gray-200  w-full grid">
      <div v-if="images.length" class="grid grid-cols-12 gap-2">
        <div v-for="image in images" :key="image.id" class="xl:col-span-6 col-span-12 rounded-xl relative">
              <img :src="image.src" class="h-full rounded-sm w-full">
        </div>
        
      </div>
      <!-- <div v-else class="flex items-center justify-center">
        <span>No images</span>
      </div> -->
      <div v-if="videos.length" class="grid grid-cols-12 gap-2">
        <div v-for="video in videos" :key="video.id" class="xl:col-span-6 col-span-12 rounded-xl relative">
          <video class="h-full rounded-sm w-full" controls>
             <source :src="video.src" type="video/mp4">
                </video> 
        </div>
        
      </div>
    </div>
    <div class="md:col-span-4  gap-2 flex flex-col ">

          <Box class="col-span-12 md:col-span-4" >
            <template #header>Infor</template>
            <Price class="text-2xl" :price="props.listing.price "></Price> 
            <ListingSpace :listing="props.listing"></ListingSpace> <br />
            <ListingAddress :listing="props.listing"></ListingAddress> <br />
          </Box>
          <div class="col-span-12 md:col-span-8">
            <Box class="flex-1"  >
              <template #header>Monthly Payment</template>
              <div>
                <label class="label">Interest rate ({{ interestRate }}%)</label>
                <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                class="w-full h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-200"
                >
              </div>
              <div>
                <label class="label">Duration ({{ year }} year)</label>
                <input v-model.number="year" type="range" min="3" max="30" step="1"
                class="w-full h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-200"
                >
              </div>
              <div class="text-gray-600 dark:text-gray-200 mt-2">
                <div class="text-lg">Your Monthly Payment:</div>
                <div  class="text-2xl font-bold">{{ monthlyPayment }}$</div>
              </div>

            </Box>

            <div v-if="page.props.auth.user">
              <ShowOffer v-if="props.offer" :offer="props.offer">

              </ShowOffer>
              <div v-else> 
                <MakeOffer v-if="page.props.auth.user.id != props.listing.user_id " @offerUpdated="receiveEvent" :listing="props.listing" >

                </MakeOffer>
              </div>
            </div>

          </div>





    </div>
   

    <div class=" col-span-12 text-center flex justify-center px-40">
      <iframe class="w-full " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.5574445806537!2d108.20760737575965!3d16.036537240310974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142199388f2bd49%3A0xd9a4963781c02c50!2zMzYzIE5ndXnhu4VuIEjhu691IFRo4buNLCBLaHXDqiBUcnVuZywgQ-G6qW0gTOG7hywgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1728701800980!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


    
    <Rating  :listing="props.listing" :ratings="props.ratings" :auth="props.auth" :is_commented="props.is_commented"></Rating>

  </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/dist";
import ListingAddress from "../../Components/ListingAddress.vue";
import ListingSpace from "../../Components/ListingSpace.vue";
import Box from "../../Layouts/Box.vue";
import Rating from './ShowComponent/Rating.vue'


import { useMonthlyPayment } from "../../Composables/useMonthlyPayment";
import MakeOffer from "./ShowComponent/MakeOffer.vue";
import Price from "../../Components/Price.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import ShowOffer from "./ShowComponent/ShowOffer.vue";
import Slider from "./ShowComponent/Slider.vue";



const interestRate = ref(2.5);
const year = ref(25);

const page = usePage();

const props = defineProps({
  listing: Object,
  images: Array,
  videos: Array,
  offer: Object,
  ratings: Array,
  auth: Object,
  is_commented: Object
});

const offer = ref(props.listing.price);


console.log(props.images);
const monthlyPayment = ref(useMonthlyPayment(offer,interestRate,year).monthlyPayment);

const receiveEvent = (event) => {
    offer.value = event;
}

</script>
