<template>
    <MenuItem v-slot="{ active }">
        <a href=""
        class="text-gray-700 block  px-4 text-sm relative"
        > Upload File
        <input type="file" class="absolute left-0 top bottom-0 right-0
         cursor-pointer opacity-0 ">
    </a>
         
     </MenuItem>
</template>
<script>
import { MenuItem } from '@headlessui/vue';

export default {
    components: { MenuItem }
}
</script>