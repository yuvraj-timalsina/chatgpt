<script setup>
import {computed} from "vue";

const user = computed(() => props.content?.role === "user")
const props = defineProps({
    content: Object
})
</script>
<template>
    <div :class="user?'bg-slate-800 font-bold' : 'bg-slate-700'" class="w-full flex text-white py-6">
    <span class="w-1/6 flex justify-end pr-4">
        <svg v-if="content.role==='user'" class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor"
             stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round"
        stroke-linejoin="round"/>
</svg>
    <svg v-else class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


    </span>
        <section class="w-4/6 text-left pl-4 pt-2">
            {{ content?.content }}
        </section>
    </div>
</template>

