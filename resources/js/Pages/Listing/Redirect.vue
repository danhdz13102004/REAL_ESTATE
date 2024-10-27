<template>
    
</template>

<script setup>

const props = defineProps({
    url: String
});

window.location.href = props.url;
</script>