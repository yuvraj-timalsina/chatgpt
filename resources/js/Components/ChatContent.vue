<script setup>
import {computed} from "vue";
const user = computed(()=>props.content?.role==="user")
const props = defineProps({
    content: Object
})
</script>
<template>
    <div class="w-full flex text-white py-6" :class="user?'bg-slate-800 font-bold' : 'bg-slate-700'">
    <span class="w-1/6 flex justify-end pr-4">
        <svg v-if="content.role==='user'" class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor"
             stroke-width="1.5"
             viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
  <path
      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
      stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>
    <svg v-else class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


    </span>
        <section class="w-4/6 text-left pl-4">
            {{ content?.content }}
        </section>
    </div>
</template>

