

<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4 ">
       <Navigation />
       <main class="flex flex-col flex-1 px-4 overflow-hidden">
        <div class="flex items-center justify-between w-full ">
            <form action="" class="w-[600px] h-[80px] flex  items-center">

                <TextInput 
                v-model="form.search"
                autocomplete="" 
             placeholder="Search for Files and Folders"
             class="block w-full mr-2" type="text"
                />
            </form>
            <UserSettingsDrodown />
        </div>

        <div class="flex flex-1 flex-col  overflow-hidden">
      <slot/>
        </div>

        
    </main>
    </div>
</template>

<script setup>

import Navigation from "@/Components/app/Navigation.vue"
import SearchForm from "@/Components/app/SearchForm.vue";
import TextInput from "../Components/TextInput.vue";
import UserSettingsDrodown from"@/Components/app/UserSettingsDropdown.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { FILE_UPLOAD_STARTED, emitter } from "@/event-bus";

const form = useForm({
    search: ""
})

function uploadFiles()
{
    console.log(files);
}


onMounted(() =>{
    emitter.on(FILE_UPLOAD_STARTED , uploadFiles)
})
</script>
