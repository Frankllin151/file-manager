<script>
import TextInput from "@/Components/TextInput.vue";
import { useForm } from '@inertiajs/vue3';



export default {
    
}
</script>
<template>
   <form action="" class="w-[600px] h-[80px] flex  items-center">

    <TextInput 
    autocomplete="" 
 placeholder="Search for Files and Folders"
 class="block w-full mr-2" type="text"
    />
</form>
  
</template>