<template>
    <div class="max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl w-full">
        <PostComponent  ></PostComponent>
    </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import PostComponent from '@/Components/PostComponent'
import {reactive} from "vue";

const data = reactive({})

</script>

<style scoped>

</style>
