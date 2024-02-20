

<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4 "
    @drop.prevent="handleDrop"
              @dragover.prevent="onDragover"
              @dragleave.prevent="onDragleave"
              :class="dragOver ? 'dropzone' : '' "
    >
       <Navigation />
       <main 
       class="flex flex-col flex-1 px-4 overflow-hidden">
       
       <template v-if="dragOver" class="text-gray-500 text-center py-8 text-sm">  
       
        Drop Files Here to Upload
       </template>
        <template v-else>
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
        </template>

        
    </main>
    </div>
</template>

<script setup>

import Navigation from "@/Components/app/Navigation.vue"
import SearchForm from "@/Components/app/SearchForm.vue";
import TextInput from "../Components/TextInput.vue";
import UserSettingsDrodown from"@/Components/app/UserSettingsDropdown.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted , ref } from "vue";
import { FILE_UPLOAD_STARTED, emitter } from "@/event-bus";

const form = useForm({
    search: ""
})


/// refs 

const dragOver = ref(false);




function onDragover ()
{

    dragOver.value = true
}
function onDragleave ()
{
    dragOver.value = false
}



function handleDrop (ev)
{
const files =  ev.dataTransfer.files;
console.log(files);

if(!files.lenght){
 return
}

uploadFiles(files);
}


function uploadFiles(files)
{
    console.log(files);
}

onMounted(() =>{
    emitter.on(FILE_UPLOAD_STARTED , uploadFiles)
})
</script>

<style scoped>
.dropzone{
    width: 100%;
    height: 100%;
    color: #8d8d8d;
    border: 2px dashed gray;
    display: flex;
    justify-content: center;
    align-items: center;

}
</style>