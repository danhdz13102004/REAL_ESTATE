<template>
    <div class="overflow-hidden">
      <div
        class="flex "
        
        @mousedown="startDrag"
        @mouseup="endDrag"
        @mouseleave="endDrag"
        @mousemove="drag"
      >
        <img
          v-for="image in images"
          :key="image.id"
          :src="image.src"
          alt="Image"
          class=""
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      images: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        currentIndex: 0,
        isDragging: false,
        startX: 0,
        currentX: 0,
      };
    },
    methods: {
      startDrag(event) {
        this.isDragging = true;
        this.startX = event.clientX;
      },
      endDrag() {
        if (this.isDragging) {
          const deltaX = this.startX - this.currentX;
          if (deltaX > 50) {
            this.nextImage();
          } else if (deltaX < -50) {
            this.prevImage();
          }
        }
        this.isDragging = false;
      },
      drag(event) {
        if (this.isDragging) {
          this.currentX = event.clientX;
        }
      },
      nextImage() {
        if (this.currentIndex < this.images.length - 1) {
          this.currentIndex++;
        }
      },
      prevImage() {
        if (this.currentIndex > 0) {
          this.currentIndex--;
        }
      },
    },
    mounted() {
    console.log('Images prop:', this.images);
    }
  };

  </script>
  


  <style scoped>
  .image-slider {
    /* Optional: set the height of the slider */
    height: 300px;
  }
  </style>
  