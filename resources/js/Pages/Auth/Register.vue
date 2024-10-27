<template>
    <form @submit.prevent="create" class="px-96">
        <div >
            <label class="label">Name</label>
            <input class="input_add" v-model="form.name">
            <span class="tag_error" v-if="page.props.flash.validate && page.props.flash.validate.name">
                {{ page.props.flash.validate.name[0] }}
            </span>
        </div>
        <div class="mt-2 ">
            <label class="label">Email</label>
            <input class="input_add" v-model="form.email" type="email">
            <span class="tag_error" v-if="page.props.flash.validate && page.props.flash.validate.email">
                {{ page.props.flash.validate.email[0] }}
            </span>
        </div>
        <div class="mt-2">
            <label class="label">Password</label>
            <input class="input_add" v-model="form.password" type="password">
            <span class="tag_error" v-if="page.props.flash.validate && page.props.flash.validate.password">
                {{ page.props.flash.validate.password[0] }}
            </span>
        </div>
        <div class="mt-2">
            <label class="label">Confirm password</label>
            <input class="input_add" v-model="form.password_confirmation">
            <span class="tag_error" v-if="page.props.flash.validate && page.props.flash.validate.password_confirmation">
                {{ page.props.flash.validate.password_confirmation[0] }}
            </span>
        </div>
        <div>
            <button class="w-full btn-primary mt-6">Register</button>
        </div>
        <Link class="flex  items-center w-full mt-2" :href="'/login'">
            <span class="mx-auto font-semibold">
                Already have an account, click here
            </span>
        </Link>
    </form>


</template>

<script setup>
import { Link, useForm,usePage } from '@inertiajs/vue3';
import { route } from '../../../../vendor/tightenco/ziggy/dist';

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const create = () => {
    form.post(route('create'));
}
</script>
