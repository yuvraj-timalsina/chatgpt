<script setup>
import ChatLayout from "@/Layouts/ChatLayout.vue"
import {Link, useForm} from "@inertiajs/vue3"

const props = defineProps({
    messages: Array,
    chat: null | Object
})
const form = useForm({
    prompt: ""
})

const submit = () => {
    form.post("/chat")
}
</script>

<template>
    <ChatLayout>
        <template #aside>
            <ul class="p-2">
                <template v-for="message in messages" :key="message.id">
                    <li class="px-4 py-2 my-2 flex justify-between font-semibold text-slate-400 bg-slate-900 hover:bg-slate-700 rounded-lg duration-200">
                        <Link :href="`/chat/${message.id}`">
                            {{ message.context[0].content }}
                        </Link>
                    </li>
                </template>
            </ul>
        </template>
        <div class="w-full flex text-white">

        </div>
        <template #form>
            <section class="px-6 top-0">
                <div class="w-full">
                    <div class="relative flex-1 flex items-center">
                        <input v-model="form.prompt" class="w-full bg-slate-700 text-white rounded-lg"
                               placeholder="Ask Laravel AI"
                               type="text"
                               @keyup.enter="submit">
                        <div class="absolute inset-y-0 right-0 flex items-center pl-3">
                            <svg class="w-6 h-6 -ml-8 text-slate-200" fill="none" stroke="currentColor"
                                 stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </ChatLayout>
</template>
