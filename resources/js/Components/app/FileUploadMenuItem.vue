<template>
    <MenuItem v-slot="{ active }">
        <a href=""
        class="text-gray-700 block  px-4 text-sm relative"
        > Upload File
        <input @change="onChange" type="file" class="absolute left-0 top bottom-0 right-0
         cursor-pointer opacity-0 " multiple>
    </a>
         
     </MenuItem>
</template>
<script setup>
import { MenuItem } from '@headlessui/vue';
import { FILE_UPLOAD_STARTED, emitter } from '@/event-bus.js';

// Methods 
 function onChange(ev)
 {
  
   emitter.emit(FILE_UPLOAD_STARTED , ev.target.files)
 }
</script>