<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Dashboard">
<div class="drawer drawer-mobile">
  <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
  <div class="drawer-content flex flex-col ">
    <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div>
                      <h1 class="text-2xl font-bold">Backlog</h1>
                    </div>
                    
                </div>
                <div class="overflow-x-auto w-full mt-5">
                <table class="table w-full">
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
          <span class="badge badge-ghost badge-sm bg-blue-300">EN COURS</span>
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
            </div>
        </div>
    <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
  
  </div> 
  <div class="drawer-side">
    <label for="my-drawer-2" class="drawer-overlay"></label> 
    
    <ul class="menu p-4 overflow-y-auto w-80 bg-base-100 text-base-content">
    <h2>Menu</h2>
      <!-- Sidebar content here -->
      <li><a>Sidebar Item 1</a></li>
      <li><a>Sidebar Item 2</a></li>
    </ul>
  
  </div>
</div>
        
    </AppLayout>
</template>
