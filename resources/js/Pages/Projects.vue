<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

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
      <tr>
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="https://ui-avatars.com/api/?name=TA72 Inscription" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">TA72 Inscription</div>
              <div class="text-sm opacity-50">Alexis Dampt</div>
            </div>
          </div>
        </td>
        <td>
          <span class="badge badge-ghost badge-sm bg-green-300">Sprint en cours</span>
        </td>
        <td>32 <b>Taches</b>
        <br>5 <b>Sprints</b>
        </td>
        <td class="text-right">
          Mise a jours <b>il y a un jour</b>
        </td>
      </tr>

       <!-- row 2 -->
      <tr>
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="https://ui-avatars.com/api/?name=Ile de France Site" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">Ile de France Site</div>
              <div class="text-sm opacity-50">Thomas Tse</div>
            </div>
          </div>
        </td>
        <td>
          <span class="badge badge-ghost badge-sm bg-green-300">Sprint en cours</span>
        </td>
        <td>32 <b>Taches</b>
        <br>5 <b>Sprints</b>
        </td>
        <td class="text-right">
          Mise a jours <b>il y a un jour</b>
        </td>
      </tr>
    </tbody>
    
  </table>
</div>
            </div>
        </div>
    </AppLayout>
</template>
