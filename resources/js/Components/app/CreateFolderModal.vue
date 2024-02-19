<template>
    <modal :show="modelValue" @show="onShow" max-width="sm">
        <div class="p-6">
                 <h2 class="text-lg font-medium  text-gray-900 ">
                    Create new Folder
                 </h2>
                 <div class="mt-6">
                    <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
                    <TextInput type="text" id="folderName"
                    :ref="folderNameInput"
                    v-model="form.name"
                    class="mt-1 blck w-full "
                    :class="form.errors && form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"

                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                    />
                    <InputError :message="form.errors.name" class="mt-2"/>
                 </div>


                 <div class="mt-6 flex justify-end">
                   <SecondaryButton
                   @click="closeModal"
                   >Cancel</SecondaryButton>
                   <PrimaryButton
                  @click="createFolder" 
                  class="ml-3"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                   >
                   Submit
                </PrimaryButton>
                 </div>
        </div>

    </modal>
</template>

<script setup>
// Imports

import Modal from "@/Components/Modal.vue";
import InputLabel from "../InputLabel.vue";
import TextInput from "../TextInput.vue";
import InputError from '../InputError.vue';
import { useForm ,  usePage  } from "@inertiajs/vue3";
import SecondaryButton from "../SecondaryButton.vue";
import PrimaryButton from '../PrimaryButton.vue';
import myFile from "@/Pages/MyFiles.vue";
import { ref,nextTick , onBeforeMount  } from "vue";
// Uses
var form = useForm({

  name: '',
  parent_id: null 
  
}) 
const page = usePage();
const idFolder = page.props.folder.data.id;


// Refs 
var folderNameInput = ref(null);
// Props & Emit
const {modelValue} = defineProps({
    modelValue: Boolean 
})
const emit = defineEmits(['update:modelValue'] , ['folder'])

// Computed

// methods



function createFolder() {

form.parent_id = idFolder

console.log(form.parent_id);

form.post(route('folder.create'), {
    preserveScroll: true,
    onSuccess: () => {
        closeModal()
        // Show success notification

        form.reset();
    },
    onError: () => folderNameInput.value.focus()
})
}



function onShow()
{
   // Assuming you have a ref named folderNameInput defined in your component
  const folderNameInput = ref(null);

  // Use nextTick to wait for the DOM to be updated before accessing the element
  nextTick(() => {
    if (folderNameInput.value) {
      // Check if folderNameInput is not null or undefined before calling focus
      folderNameInput.value.focus();
    }
  });
}




function closeModal()
{
    emit('update:modelValue')
    form.clearErrors();
    form.reset()
}
// Hooks
</script>