<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Dashboard">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projet #1
            </h2>
        </template>
<div class="px-4">
<div class="flex justify-end py-3">
                    <div>
                      <label for="my-modal" class="btn btn-primary modal-button">Créer une tâche</label >
                    </div>
                </div>
<table class="table w-full mt-2 px-3">
    <!-- head -->
    <tbody>

       <!-- row 2 -->
      <tr>
        <td>
          <div class="flex items-center space-x-1">
            <div>
              <span class="font-bold">#3</span>
            </div>
          </div>
        </td>

        <td>
          <div class="flex items-center space-x-1">
            <div>
              <span>Update Doc</span>
            </div>
          </div>
        </td>
        <td>
          <span class="badge badge-ghost badge-sm bg-blue-300">En cours</span>
        </td>
        <td class="p-2 ">
       <div class="avatar">
              <div class="mask mask-squircle w-9 h-9">
                <img src="https://ui-avatars.com/api/?name=Ile de France Site" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
        </td>
      </tr>
    </tbody>
    
  </table>

</div>
<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Créer une tâche</h3>
    <p class="py-4">Nom de la tâche</p>
    <input type="text"  class="input input-bordered input-primary w-full max-w-xs"   />
    <p class="py-4">Description</p>
    <input type="text" class="input input-bordered input-primary w-full max-w-xs"   />
<p class="py-4">Poids</p>
    <input type="text" class="input input-bordered input-primary w-full max-w-xs"   />
    <div class="modal-action">
      <label for="my-modal" class="btn">Créer</label>
    </div>
  </div>
</div>
                
        
    </AppLayout>
</template>
