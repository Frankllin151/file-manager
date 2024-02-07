<template>

   
   <AuthenticatedLayout>
      <div class="flex-1 overflow-auto">
         <table  class="min-w-full">
           <thead class="bg-gray-100 border-b">
             <tr>
               <th class="text-sm font-medium text-gray-900 px-6 py-4">
                 Name
               </th>
               <th class="text-sm font-medium text-gray-900 px-6 py-4">
                 Owner
               </th>
               <th class="text-sm font-medium text-gray-900 px-6 py-4">
                 Last Modified
               </th>
               <th class="text-sm font-medium text-gray-900 px-6 py-4">
                 Size
               </th>
             </tr>
           </thead>
     
           <tbody>
             <tr
               v-for="file in files.data"
               :key="file.id"
               @click="openFolder(file)"
               class="bg-white border-b transition duration-300 ease-in-out 
               hover:bg-gray-300 cursor-pointer"
             >
             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
             text-gray-900 ">
             {{ file.name }}
          </td>
             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
             text-gray-900 ">
             {{ file.owner }}
          </td>
 
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
             text-gray-900  ">
             {{ file.updated_at }}
          </td>
 
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
             text-gray-900 ">
             {{ file.size }}
       </td>
             </tr>
           </tbody>
         </table>

         <div v-if="!files.data.length" class="py-8 text-center text-lg text-gray-400">
           There is no data in this Folder
         </div>
        
       </div>
   </AuthenticatedLayout>

   <!---
  
   -->
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {router, useForm, usePage} from "@inertiajs/vue3";
// Props
const { files } = defineProps({
   files: Object
});

// Methods 

function openFolder(file) {
    if (!file.is_folder) {
        return;
    }
   router.visit(route('myFiles', { folder: file.path }));
  
 
}
</script>