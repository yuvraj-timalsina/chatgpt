<script setup>
import ChatLayout from "@/Layouts/ChatLayout.vue"
import {Head, Link, useForm} from "@inertiajs/vue3"
import ChatContent from "@/Components/ChatContent.vue";
import {computed, onMounted, ref} from "vue";
import Skeleton from "@/Components/Skeleton.vue";

const promptInput = ref(null)
const chatContainer = ref(null)
const showDeleteButton = ref(false)

const props = defineProps({
    messages: Array,
    chat: null | Object
})
const form = useForm({
    prompt: ""
})

const submit = () => {
    const url = props.chat ? `/chat/${props.chat?.id}` : '/chat'
    form.post(url, {
        onFinish: () => clear()
    })
}

const scrollToBottom = () => {
    if (props.chat) {
        const el = chatContainer.value
        el.scrollTop = el.scrollHeight
    }
}

const clear = () => {
    form.prompt = ""
    promptInput.value.focus()
    scrollToBottom()
}

onMounted(() => {
    clear()
})
const title = computed(() => props.chat?.context[0].content ?? 'New Chat')
</script>

<template>
    <Head :title="title"/>
    <ChatLayout>
        <template #aside>
            <ul class="p-2">
                <li v-if="chat"
                    class="px-4 py-2 my-2 flex justify-between font-semibold text-green-400 bg-slate-900 hover:bg-slate-700 rounded-lg duration-200">
                    <Link class="w-full" href="/chat">
                        New Chat
                    </Link>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </li>
                <template v-for="message in messages" :key="message.id">
                    <li :class="[message.id===chat?.id ? 'bg-slate-700' : 'bg-slate-900', 'px-4 py-2 my-2 flex justify-between font-semibold text-slate-400 hover:bg-slate-700 rounded-lg duration-200']">
                        <Link :href="`/chat/${message.id}`">
                            {{ message.context[0].content }}
                        </Link>
                        <div v-if="message.id===chat?.id">
                            <button v-if="!showDeleteButton" @click="showDeleteButton = !showDeleteButton">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <span v-if="showDeleteButton" class="flex justify-between">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                 <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                               <button @click="showDeleteButton = false">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                               </button>
                            </span>
                        </div>
                    </li>
                </template>
            </ul>
        </template>
        <div class="w-full flex text-white">
            <template v-if="chat">
                <div class="w-full flex h-screen bg-slate-900">
                    <div ref="chatContainer" class="w-full overflow-auto pb-36">
                        <template v-for="(content, index) in chat?.context" :key="index">
                            <ChatContent :content="content"/>
                        </template>
                        <Skeleton v-show="form.processing"/>
                    </div>
                </div>
            </template>
        </div>
        <template #form>
            <section class="px-6 top-0">
                <div class="w-full">
                    <div class="relative flex-1 flex items-center">
                        <input ref="promptInput" v-model="form.prompt"
                               :disabled="form.processing"
                               class="w-full bg-slate-700 text-white rounded-lg"
                               placeholder="Ask Laravel AI"
                               type="text"
                               @keyup.enter="submit"
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pl-3">
                            <svg v-if="!form.processing" class="w-6 h-6 -ml-8 text-slate-200" fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                            <div v-if="form.processing" class="dot-typing -ml-10"></div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </ChatLayout>
</template>
<style>
.dot-typing {
    position: relative;
    left: -9999px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #9880ff;
    color: #9880ff;
    box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
    10014px 0 0 0 #9880ff;
    animation: dot-typing 1.5s infinite linear;
}

@keyframes dot-typing {
    0% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    16.667% {
        box-shadow: 9984px -10px 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    33.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    50% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px -10px 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    66.667% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    83.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px -10px 0 0 #9880ff;
    }
    100% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
}
</style>
