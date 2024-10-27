<template>

    <Box class="mt-2">
        <div class="flex justify-between">
            <span class="text-xl font-bold">Your notifications</span>
            <button @click="markAll" class="px-4 py-2 border dark:border-white border-black text-sm rounded-md font-bold" >Mark all as read</button>
        </div>
        <div class="flex justify-between items-center mt-2 border-b border-dashed py-4" v-for="notification in notifications.data" :key="notification.id">
            <div>
                <span :class="{'font-bold': !notification.read_at}">
                    Offer 
                    <Price :price="notification.data.amount"></Price>
                    for 
                    <span @click="markAsRead(notification)" class="cursor-pointer font-bold text-indigo-500 dark:text-indigo-700">listings</span>
                    was made
                </span>
            </div>
            <!-- <div>
                <button @click="markAsRead(notification)" class="px-4 py-2 border dark:border-white border-black text-sm rounded-md font-bold">Mark as read</button>
            </div> -->
        </div>
        <div class="flex mt-4 items-center justify-center" v-if="notifications.data.length > 5">
            <Pagination :links="notifications.links"></Pagination>
        </div>
    </Box>    

</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Box from '../../Layouts/Box.vue';
import { route } from '../../../../vendor/tightenco/ziggy/dist';
import Price from '../../Components/Price.vue';
import Pagination from '../Listing/Pagination.vue';

defineProps({
    notifications: Object
})

const markAsRead = (notification) => {
    router.patch(route('notification.update',notification.id));
}

const markAll = () => {
    router.put(route('notification.markall'));
}

</script>