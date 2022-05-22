<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import image from '../../image/logo.png'
const IMG = image
</script>

<template>
    <Link :href="'/'">
        <img :src="IMG" class="w-40" alt="Logo Gram">
    </Link>
</template>
