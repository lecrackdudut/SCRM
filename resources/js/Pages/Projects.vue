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
                      <button class="btn btn-primary">Creer un projet</button>
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
          <a :href="`projects/1`">
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img :src="`https://ui-avatars.com/api/?name=${project.name}`" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">{{project.name}}</div>
              <div class="text-sm opacity-50">Alexis Dampt</div>
            </div>
          </div>
          </a>
        </td>
        
        <td>
          <span class="badge badge-ghost badge-sm bg-green-300">{{project.sprint_duration}}</span>
        </td>
        <td>{{project.nbTasks}} <b>Taches</b>
        <br>{{project.nbSprints}} <b>Sprints</b>
        </td>
        <td class="text-right">
          Mis à jour <b>{{project.majRelative}}</b>
        </td>
      </tr>

    </tbody>
    
  </table>
</div>
            </div>
        </div>
    </AppLayout>
</template>
