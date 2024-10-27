<template>
    <form>
      <div class="mb-4 mt-4 flex flex-wrap gap-2">
        <div class="flex flex-nowrap items-center gap-2">
          <input
            id="deleted"
            v-model="filterForm.deleted"
            type="checkbox" class="h-4 w-4  border-gray-300 text-indigo-600 focus:ring-indigo-500"
          />
          <label for="deleted">Deleted</label>
          <select class="select-filter" v-model="filterForm.by">
              <option value="created_at">Added</option>
              <option value="price">Price</option>
          </select>

          <select class="select-filter-r" v-model="filterForm.order">
              <option v-for="order in listOptions" :value="order.value" :key="order.value"> {{ order.label }}</option>
          </select>
        </div>
      </div>
    </form>
  </template>
  <script setup>
import {  useForm } from '@inertiajs/vue3';
import { computed, reactive, watch } from 'vue';
import { route } from '../../../../vendor/tightenco/ziggy/dist';
import { debounce } from 'lodash';

const props = defineProps({
  filters: Object
})

console.log(props.filters);
  const filterForm = useForm({
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ??   'created_at',
    order: props.filters.order ??  'asc'
  })

  watch(() => [filterForm.deleted,filterForm.by,filterForm.order], (newVal, oldVal) => {
      deboundRequest();
});


const sortLabels = {
  created_at: [
    {
      label: 'Lastest',
      value: 'asc'
    },
    {
      label: 'Oldest',
      value: 'desc'
    }
  ],
  price: [
    {
      label: 'Pricey',
      value: 'desc'
    },
    {
      label: 'Cheapest',
      value: 'asc'
    }
  ]
}

const listOptions = computed(() => sortLabels[filterForm.by]);



  const deboundRequest = debounce(() =>{
    filterForm.get(route('realtor.listings.index'));
  },1 );
  </script>