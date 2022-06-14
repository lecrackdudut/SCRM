<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
  projects: Array
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projets
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <div>
                      <label   for="my-modal" class="btn btn-primary modal-button">Creer un projet</label >

                    </div>
                    
                </div>
                <div class="overflow-x-auto w-full mt-5">
  <table class="table w-full">
    <!-- head -->
    <tbody>
      <!-- row 1 -->
      <tr v-for="project in projects"
          :key="project.id">
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="https://ui-avatars.com/api/?name=TA72 Inscription" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">{{project.name}}</div>
              <div class="text-sm opacity-50">Alexis Dampt</div>
            </div>
          </div>
        </td>
        <td>
          <span class="badge badge-ghost badge-sm bg-green-300">{{project.sprint_duration}}</span>
        </td>
        <td>{{project.nbSprints}} <b>Taches</b>
        <br>{{project.nbTasks}} <b>Sprints</b>
        </td>
        <td class="text-right">
          Mis à jour le <b>{{project.majRelative}}</b>
        </td>
      </tr>
    </tbody>
    
  </table>
  <input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Creer un projet</h3>
    <p class="py-4">Nom du projet</p>
    <input type="text"  class="input input-bordered input-primary w-full max-w-xs"   />
    <p class="py-4">Description</p>
    <input type="text" class="input input-bordered input-primary w-full max-w-xs"   />
    <p class="py-4">Membres</p>
    <input type="text"  class="input input-bordered input-primary w-full max-w-xs" disabled  />
    <p class="py-4">Documents</p>
    <input type="text"  class="input input-bordered input-primary w-full max-w-xs" disabled  />

    <div class="modal-action">
      <label for="my-modal" class="btn">Creer</label>
    </div>
  </div>
</div>
</div>
            </div>
        </div>
    </AppLayout>
</template>
