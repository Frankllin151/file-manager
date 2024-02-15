<template>
    <MenuItem v-slot="{ active }">
        <a href=""
        class="text-gray-700 block  px-4 text-sm"
        > Upload File</a>
         
     </MenuItem>
</template>
<script>
import { MenuItem } from '@headlessui/vue';

export default {
    components: { MenuItem }
}
</script>