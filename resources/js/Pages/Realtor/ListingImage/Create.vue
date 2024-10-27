<template>
    <Box class="text-center">
        <template  #header>Upload your image</template>
        <div enctype="multipart/form-data" method="post" :action="route('realtor.listings.image.store',{listing: listing.id})" class="text-center my-2  "  >   
            <input class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-100 file:border-0 file:bg-gray-100 file:dark:bg-gray-600 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-400 file:hover:cursor-pointer file:mr-4 mr-2" type="file" multiple name="images[]" @input="addFile" />
            <button @click="upload" class="btn-primary">Upload</button>
        </div>
        <div v-if="page.props.flash.validate ">
            <span class="text-red-600 font-bold" v-for="(error,index) in page.props.flash.validate" :key="index" >{{ error }}</span>
        </div>
    </Box>

    <div v-if="images.length" class="grid grid-cols-12 mt-8 mx-8 gap-4">
        <div v-for="image in images" :key="image.id" class="col-span-12 md:col-span-6 xl:col-span-4 rounded-xl relative">
            <img :src="image.src" class="h-full rounded-sm w-full">
            <button @click="deleteImage(listing,image)" class="absolute top-2 right-4 text-red-700 text-2xl font-bold hover:text-red-500 ">x</button>
        </div>
        <div v-for="video in videos" :key="video.id" class="col-span-12 md:col-span-6 xl:col-span-4 rounded-xl relative">
                <video class="h-full rounded-sm w-full" controls>
             <source :src="video.src" type="video/mp4">
                </video>   
            <button @click="deleteVideo(listing,video)" class="absolute top-2 right-4 text-red-700 text-2xl font-bold hover:text-red-500 ">x</button>
        </div>
    </div>
</template>


<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/dist";
import Box from "../../../Layouts/Box.vue";
import nProgress from "nprogress";

// router.on('progress', (event) => {
//   if (event.detail.progress.percentage) {
//     nProgress.set((event.detail.progress.percentage / 100) * 0.9)
//   }
// })

const page = usePage();

const baseUrl = `${window.location.protocol}//${window.location.host}/`;


const deleteImage = (listing,image) => {
    console.log(listing,image);
    router.delete(route('realtor.listings.image.destroy',{listing: listing.id,image: image.id}));
}

const deleteVideo = (listing,video) => {
    console.log(listing,video);
    router.delete(route('realtor.listings.video.destroy',{listing: listing.id,video: video.id}));
}


const props = defineProps({
    listing: Object,
    images: Array,
    videos: Array
});

const form = useForm({
    images: []
});

const upload = () => {
    form.post(route('realtor.listings.image.store',props.listing.id), {
        onSuccess: () => {
            form.reset('images');
            console.log('reset rui ne');
            form.images = [];
        }
    })
}

const addFile = (event) => {
    for(const images of event.target.files) {
        form.images.push(images);
    }
    
}


</script>