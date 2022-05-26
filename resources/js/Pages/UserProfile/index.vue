<template>
    <AppLayout title="Dashboard">

        <div class="w-7/12">
            <div class="flex justify-center pb-10">
                <img
                    :src="props.userProfile.profile_photo_url"
                    class="h-40 w-40 rounded-full object-cover"
                    alt="username"/>
                <div class="ml-10">
                    <div class="flex items-center">
                        <h2 class="block leading-relaxed font-light text-gray-700 text-3xl">
                            {{ props.userProfile.nick_name }}</h2>
                        <a class="cursor-pointer h-7 px-3 ml-3 outline-none border-transparent text-center rounded border bg-blue-500 hover:bg-blue-600 text-white bg-transparent font-semibold">Enviar
                            mensaje</a>
                        <Link v-if="props.userProfile.id === $page.props.user.id" href="/user/profile" class="cursor-pointer h-7 px-3 ml-3 focus:outline-none hover:border-transparent text-center rounded border border-gray-400 hover:bg-blue-500 hover:text-white bg-transparent text-gray-500 font-semibold">Editar</Link>

                        <button
                            class="flex items-center ml-3 border border-blue-600 hover:bg-blue-600 hover:text-white rounded outline-none focus:outline-none bg-transparent text-blue-600 text-sm py-1 px-2">
                            <span class="block">Seguir</span>
                            <svg class="block h-5 w-5 pl-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                        <a class="cursor-pointer ml-2 p-1 border-transparent text-gray-700 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                           aria-label="Notifications">
                            <svg class="h-8 w-8" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </a>
                    </div>
                    <ul class="flex justify-content-around items-center">
                        <li>
                            <span class="block text-base flex"><span
                                class="font-bold mr-2">{{ props.postsCount }} </span> Posts</span>
                        </li>
                        <li>
                            <span class="cursor-pointer block text-base flex ml-5"><span
                                class="font-bold mr-2">{{ props.followers }} </span> Seguidores</span>
                        </li>
                        <li>
                            <span class="cursor-pointer block text-base flex ml-5"><span
                                class="font-bold mr-2">{{ props.followed }} </span> Seguidos</span>
                        </li>
                    </ul>
                    <br>
                    <div class="">
                        <h1 class="text-base font-bold font-light">{{ props.userProfile.name }}</h1>
                        <span class="text-base">{{ props.userProfile.presentation }}</span>
                        <!--                        <a :href="props.userProfile.web_site" class="block text-base text-blue-500 mt-2"
                                                   target="_blank">{{props.userProfile.web_site}}</a>-->
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-300"></div>
            <article v-if="props.posts.length > 0" class="mt-5 grid grid-cols-3 gap-10">
                <imagePost v-for="(item , index) in props.posts" :key="index" :posts="item" @show="changeStateModalPost"></imagePost>
            </article>

            <div v-else class="w-full text-center text-3xl pt-10"> No hay publicaciones</div>

            <ModalPost :show="data.show" :post="data.posts" @show="changeState"></ModalPost>


        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalPost from '@/Components/ModalPost'
import imagePost from '@/Pages/UserProfile/imagePost';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {reactive} from "vue";

let props = defineProps({
    userProfile: '',
    followers: '',
    followed: '',
    postsCount: '',
    posts: '',
})

let data = reactive({
    show: false,
    posts : []
})

let changeStateModalPost = (post) =>{
    data.posts = post
    data.show = !data.show
}

let changeState = () =>{
    data.show = !data.show
}

</script>


