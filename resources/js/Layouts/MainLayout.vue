<template>
  <div>
    
    <header class="border-b border-gray-200 bg-white dark:bg-black   ">
      <div class="container mx-auto">
        <nav class="py-4 px-4 flex justify-between items-center">
          <div class="text-lg font-medium">
              <Link :href="route('listings.index')">Listings</Link>
          </div>
          <div class="text-xl text-indigo-800 dark:text-indigo-400 font-bold text-center ">
            <Link href="/">Larazillow</Link>
          </div>
          <div  v-if="page.props.auth.user" class="flex items-center gap-4">
            <div @click="seeNotification"  class="relative cursor-pointer" >
              <svg class="w-5 fill-current text-black dark:text-white" viewBox="-1.5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <title>notification_bell [#1397]</title>
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      <g id="Dribbble-Light-Preview" transform="translate(-181.000000, -720.000000)" fill="currentColor">
        <g id="icons" transform="translate(56.000000, 160.000000)">
          <path d="M137.75,574 L129.25,574 L129.25,568 C129.25,565.334 131.375,564 133.498937,564 L133.501063,564 C135.625,564 137.75,565.334 137.75,568 L137.75,574 Z M134.5625,577 C134.5625,577.552 134.0865,578 133.5,578 C132.9135,578 132.4375,577.552 132.4375,577 L132.4375,576 L134.5625,576 L134.5625,577 Z M140.9375,574 C140.351,574 139.875,573.552 139.875,573 L139.875,568 C139.875,564.447 137.359,562.475 134.5625,562.079 L134.5625,561 C134.5625,560.448 134.0865,560 133.5,560 C132.9135,560 132.4375,560.448 132.4375,561 L132.4375,562.079 C129.641,562.475 127.125,564.447 127.125,568 L127.125,573 C127.125,573.552 126.649,574 126.0625,574 C125.476,574 125,574.448 125,575 C125,575.552 125.476,576 126.0625,576 L130.3125,576 L130.3125,577 C130.3125,578.657 131.739438,580 133.5,580 C135.260563,580 136.6875,578.657 136.6875,577 L136.6875,576 L140.9375,576 C141.524,576 142,575.552 142,575 C142,574.448 141.524,574 140.9375,574 L140.9375,574 Z" id="notification_bell-[#1397]"></path>
        </g>
      </g>
    </g>
  </g>
</svg>
              <span v-if="page.props.auth.user.notifications" class="absolute -top-2 -right-2 rounded-full bg-red-600 text-white text-xs px-1">{{ page.props.auth.user.notifications }}</span>
            </div>

            <Link :href="route('realtor.listings.index')" class="capitalize"> {{  page.props.auth.user.name }} </Link> 
            <Link style="background-color: blue; color: white;" :href="route('realtor.listings.create')" class="font-medium p-2 rounded-md text-white  ">+ New Listings</Link>
            <Link :href="route('logout')" class="" method="delete">Log out</Link>
          </div>  
          <div v-else class="flex items-center gap-4"> 
            <Link class="text-xl  text-indigo-700 font-bold dark:text-indigo-400 " :href="route('register')">Register</Link>
            <span>|</span>
            <Link class="text-xl  text-indigo-700 font-bold dark:text-indigo-400 " :href="route('login_view')"> Login</Link>
          </div>
        </nav>
      </div>
    </header>

    <div v-if="page.props.flash.success" class="px-auto flex text-center items-center px-4 rounded-sm text-white bg-green-700">
      <div class="mx-auto">{{ page.props.flash.success }}</div>
    </div>

    <slot></slot>
  </div>
</template>

<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { route } from "../../../vendor/tightenco/ziggy/dist";
const page = usePage();

defineProps({
  notifications: Object
})

const seeNotification = () => {
  router.get(route('notification.index',page.props.auth.user?.id));
};

</script>

<style scoped>
/* Add some margin for spacing instead of using &nbsp; */
a {
  margin-right: 10px;
}
</style>
