<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";
const props = defineProps({
    tasks: Array
})

const translateStatus = {
    "in_progress": "EN COURS",
    "open": "OUVERTE",
    "closed": "FERMÉE"
};

function getColor(status) {
    let color = "blue";
    if(status === "OUVERTE") color = "green";
    if(status === "FERMÉE") color = "red";
    return color;
};

function getClass(status) {
    let color = getColor(status);
    let dynamicClass = "bg-orange-200"
    if(color === "green") dynamicClass = "bg-green-200";
    else if(color === "red") dynamicClass = "bg-red-200";
    return dynamicClass;
};
</script>

<template>
    <AppLayout title="Dashboard">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Backlog
            </h2>
        </template>
<div class="px-4">
<div class="flex justify-end py-3">
                    <div>
                      <label for="my-modal" class="btn btn-primary modal-button">Creer une tâche</label >
                    </div>
                </div>
<table class="table w-full mt-2 px-3">
    <!-- head -->
    <tbody>

       <!-- row 2 -->
      <tr v-for="(task, index) in this.tasks" :key="index">
        <td>
          <div class="flex items-center space-x-1">
            <div>
              <span class="font-bold">#{{task.id}}</span>
            </div>
          </div>
        </td>

        <td>
          <div class="flex items-center space-x-1">
            <div>
              <span>{{task.title}}</span>
            </div>
          </div>
        </td>
        <td>
          <span class="badge badge-ghost badge-sm" :class="getClass(translateStatus[task.status.toLowerCase()])">{{translateStatus[task.status.toLowerCase()]}}</span>
        </td>
          <td>
              <div class="flex items-center space-x-1">
                  <div>
                      <span class="font-bold">{{task.score}}</span>
                  </div>
              </div>
          </td>
        <td class="p-2 flex space-x-3">
            <button class="btn btn-square btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <button class="btn btn-square btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 18 18">
                    <path fill="#FFFFFF" d="M13 18H5a2 2 0 0 1-2-2V7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v9a2 2 0 0 1-2 2zm3-15a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3a1 1 0 0 1 1 1z"/>
                </svg>
            </button>
        </td>

      </tr>
    </tbody>

  </table>

</div>
<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Creer un tache</h3>
    <p class="py-4">Nom du tache</p>
    <input type="text"  class="input input-bordered input-primary w-full max-w-xs"   />
    <p class="py-4">Description</p>
    <input type="text" class="input input-bordered input-primary w-full max-w-xs"   />
<p class="py-4">Poid</p>
    <input type="text" class="input input-bordered input-primary w-full max-w-xs"   />
    <div class="modal-action">
      <label for="my-modal" class="btn">Creer</label>
    </div>
  </div>
</div>


    </AppLayout>
</template>
