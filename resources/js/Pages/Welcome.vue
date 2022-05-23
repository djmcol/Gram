<template>
    <div class="max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl w-full">
        <button
            @click="changeStateShowCReatePost"
            class="w-full mb-5 text-center bg-blue-500 rounded text-white py-2 outline-none focus:outline-none hover:bg-blue-600">
            Agregar publicación
        </button>
        <PostComponent></PostComponent>

        <Modal :show="data.showModal" @close="changeStateShowCReatePost">
            <div class="p-5">
                <div class="">
                    <input v-model="data.text" type="text"
                           class="w-full outline-none focus:outline-none p-2 rounded appearance-none border-none"
                           placeholder="En que estas pensando">
                    <div class="my-5">
                        <img v-if="data.url" :src="data.url" style="max-width: 100%; max-height: 400px; margin: 0 auto">
                    </div>
                    <div class="flex justify-end">
                        <button @click="selectImage"
                                class="outline-none focus:outline-none inline-flex items-center rounded-full cursor-pointer bg-blue-500 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </button>
                        <input id="image" @change="fileChange" style="display: none" type="file" name="image"
                               accept="image/gif,image/jpeg,image/jpg,image/png">
                    </div>
                    <div class="text-red-500 p-2 mt-5">
                        {{ data.errors }}
                    </div>
                </div>
                <button
                    @click="createPost"
                    v-if="data.text.length > 0 && data.image != null"
                    class="w-full my-3 mb-5 text-center bg-blue-500 rounded text-white py-2 outline-none focus:outline-none hover:bg-blue-600">
                    Publicar
                </button>
            </div>
        </Modal>

    </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import PostComponent from '@/Components/PostComponent'
import Modal from '@/Jetstream/Modal'
import {reactive} from "vue";

const data = reactive({
    showModal: false,
    url: null,
    image: null,
    text: '',
    post: [],
    errors: null
})

let changeStateShowCReatePost = () => {
    console.log(data.showModal)
    data.showModal = !data.showModal
}

let fileChange = (e) => {
    let file = e.target.files[0]
    data.image = file
    data.url = URL.createObjectURL(file)
}

let selectImage = () => {
    document.getElementById('image').click()
}

let createPost = async () => {

    try {
        const URL = `/create-post`
        const formdata = new FormData()
        formdata.append('image', data.image)
        formdata.append('text', data.text)

        const RPT = (await axios.post(URL, formdata, {
            headers: {'Content-Type': 'multipart/form-data'}
        })).data

        data.post.unshift(RPT)

        resetForm()

    } catch (e) {
        if (e.response.status === 422) {
            data.errors = e.response.data.errors.image[0]
            setTimeout(() => {
                data.errors = null
            }, 5000)
        }

    }

}

let resetForm = () => {
    data.showModal = false
    data.url = null
    data.image = null
    data.text = ''
    data.errors = null
}

</script>

<style scoped>

</style>
