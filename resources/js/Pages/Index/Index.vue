<template>
  <div>
    <div>Index111</div>
    <Link href="/hello">Show page </Link>
    <div>
      {{ message }}
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps(["message"]);



</script>

//
<script>
//     import MainLayout from "../../Layouts/MainLayout.vue";

//     export default {
//         layout: MainLayout,
//     };
//
</script>
