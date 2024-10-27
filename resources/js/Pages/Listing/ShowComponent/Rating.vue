<template>
    <div class="col-span-12 px-24 py-8">
      <div v-if="props.auth.user && !props.is_commented" class="p-8 w-full">
        <div class="flex items-center">
          <input class="w-96 py-4 input-filter rounded-md mr-8" v-model="rating.comment" type="text" name="" id="" placeholder="Enter your comment">
          <div class="flex gap-2" >
            <div v-for="i in 5" :key="i" >
            <svg @click="rating.rate = i" v-if="i <= rating.rate" class="hover:opacity-40 w-4 dark:bg-black bg-white  text-yellow-500" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
        <title>start-favorite</title>
        <desc>Created with Sketch Beta.</desc>
        <defs></defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Icon-Set-Filled" transform="translate(-154.000000, -881.000000)" fill="currentColor">
                <path d="M186,893.244 L174.962,891.56 L170,881 L165.038,891.56 L154,893.244 L161.985,901.42 L160.095,913 L170,907.53 L179.905,913 L178.015,901.42 L186,893.244"></path>
            </g>
        </g>
    </g>
</svg>

<svg v-else @click="rating.rate = i"  class="hover:opacity-40 w-4 dark:bg-black bg-white text-yellow-500" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" stroke="currentColor" stroke-width="2">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
        <title>start-favorite</title>
        <desc>Created with Sketch Beta.</desc>
        <defs></defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Icon-Set-Outline" transform="translate(-154.000000, -881.000000)" stroke="currentColor">
                <path d="M186,893.244 L174.962,891.56 L170,881 L165.038,891.56 L154,893.244 L161.985,901.42 L160.095,913 L170,907.53 L179.905,913 L178.015,901.42 L186,893.244"></path>
            </g>
        </g>
    </g>
</svg>



          </div>
          </div>
        </div>
        <br>
        <button class="ml-4 btn-primary" @click="addRating">Comment</button>
      </div>
      <div v-if="!props.auth.user" class="w-full col-span-12 py-8" >
      <span class="text-xl font-medium dark:text-gray-200 text-gray-300">You must to login to post comment</span>
    </div>


      <div v-for="rating in ratings" :key="rating.id" class="flex items-center w-full mt-2" >
        <img v-if="!rating.user.avatar" src="https://picsum.photos/200" alt="" class="w-12 rounded-full">
        <img v-else :src="getUrl(rating.user.avatar)" alt="" class="w-12 rounded-full">
        <div class="pl-4">
          <div class="flex gap-2">
            <div>
            <span class="text-xl font-medium dark:text-gray-200 text-gray-300">Ngo Van Danh </span>
          </div>
            <div v-for="i in 5" :key="i" class="flex gap-1">
            <svg v-if="i <= rating.rate" class="w-4 dark:bg-black bg-white  text-yellow-500" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
        <title>start-favorite</title>
        <desc>Created with Sketch Beta.</desc>
        <defs></defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Icon-Set-Filled" transform="translate(-154.000000, -881.000000)" fill="currentColor">
                <path d="M186,893.244 L174.962,891.56 L170,881 L165.038,891.56 L154,893.244 L161.985,901.42 L160.095,913 L170,907.53 L179.905,913 L178.015,901.42 L186,893.244"></path>
            </g>
        </g>
    </g>
</svg>
<svg v-else  class=" w-4 dark:bg-black bg-white text-yellow-500" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" stroke="currentColor" stroke-width="2">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
        <title>start-favorite</title>
        <desc>Created with Sketch Beta.</desc>
        <defs></defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Icon-Set-Outline" transform="translate(-154.000000, -881.000000)" stroke="currentColor">
                <path d="M186,893.244 L174.962,891.56 L170,881 L165.038,891.56 L154,893.244 L161.985,901.42 L160.095,913 L170,907.53 L179.905,913 L178.015,901.42 L186,893.244"></path>
            </g>
        </g>
    </g>
</svg>




          </div>

          </div>
          <div>
            <span class="text-sm">
              {{ rating.comment }}
            </span>
          </div>
        </div>
      </div>
    </div>
</template>


<script setup>
import { useForm } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/dist";

const props = defineProps({
  listing: Object,
  ratings: Array,
  auth: Object,
  is_commented: Object
});

const rating = useForm({
  comment: null,
  rate: 5
});

const resetForm = () => {
  rating.comment = null,
  rating.rate = 5;
}
const addRating = () => {
    rating.post(route('realtor.listings.rating.store',props.listing.id));
    resetForm();
}

const getUrl = (url) => {
  var rootUrl = window.location.origin;
  return rootUrl + "/storage/" + url; 
}

</script>