<template>
  <form  @submit.prevent="create" class="px-8">
    <div class="grid grid-cols-12 gap-4 ">
      <div class="col-span-4">
        <label class="label" >Beds</label>
        <input class="input_add" v-model.number="form.beds" type="text" />
        <!-- <div v-if="form.errors.beds" style="color: red; " class="text-red-700">
            {{ form.errors.beds }}
        </div> -->
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.beds">
            {{ page.props.flash.validate.beds[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">Baths</label>
        <input class="input_add" v-model.number="form.baths" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.baths">
            {{ page.props.flash.validate.baths[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">Area</label>
        <input class="input_add" v-model.number="form.area" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.area">
            {{ page.props.flash.validate.area[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-8">
        <label class="label">City</label>
        <input class="input_add" v-model="form.city" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.city">
            {{ page.props.flash.validate.city[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">Post Code</label>
        <input class="input_add" v-model="form.code" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.code">
            {{ page.props.flash.validate.code[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-8">
        <label class="label">Street</label>
        <input class="input_add" v-model="form.street" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.street">
            {{ page.props.flash.validate.street[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">Street Nr</label>
        <input class="input_add" v-model="form.street_nr" type="text" />
        <div style="color: red;" v-if="page.props.flash.validate" class="r">
          <span v-if="page.props.flash.validate.street_nr">
            {{ page.props.flash.validate.street_nr[0] }}
          </span>
        </div>
      </div>

      <div class="col-span-12">
        <label class="label">Price</label>
        <input class="input_add" v-model.number="form.price" type="text" />
        <div  v-if="page.props.flash.validate" >
          <span style="color: red;" v-if="page.props.flash.validate.price">
            {{ page.props.flash.validate.price[0] }}
          </span>
        </div>
      </div>

      <div>
        <button class="btn-primary" type="submit">Create</button>
      </div>
    </div>
  </form>
</template>

<script setup>

import { useForm, usePage } from "@inertiajs/vue3";
import { route } from "../../../../vendor/tightenco/ziggy/dist";


const page = usePage();


const form = useForm({
  beds: 0,
  baths: 0,
  area: 0,
  city: null,
  street: null,
  code: null,
  street_nr: null,
  price: 0,
});

const create = () => {
   const res =  form.post(route('realtor.listings.store'));
    if(res) {
      form.reset();
    }
  }



</script>





<style scoped>
label {
  margin-right: 2em;
}
div {
  padding: 2px;
}


</style>


