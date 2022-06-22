<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/inertia-vue3';

import {Inertia} from '@inertiajs/inertia';
import {getCurrentInstance, defineComponent} from 'vue'

const props = defineProps({
    tasks: Array,
    projectId: Number,
})

const translateStatus = {
    "in_progress": "EN COURS",
    "open": "OUVERTE",
    "closed": "FERMÉE"
};

const form = useForm({
    title: null,
    description: null,
    status: "open",
    score: null,
    projectId: props.projectId
})

function getColor(status) {
    let color = "blue";
    if (status === "OUVERTE") color = "green";
    if (status === "FERMÉE") color = "red";
    return color;
}

function getClass(status) {
    let color = getColor(status);
    let dynamicClass = "bg-orange-200"
    if (color === "green") dynamicClass = "bg-green-200";
    else if (color === "red") dynamicClass = "bg-red-200";
    return dynamicClass;
}

function closeModal() {
    document.getElementById("my-modal").checked = false;
}
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
                    <label class="btn btn-primary modal-button" for="my-modal">Créer une tâche</label>
                </div>
            </div>

            <table class="table w-full mt-2 px-3">
                <!-- head -->
                <tbody>

                <!-- row 2 -->
                <tr v-for="(task, index) in tasks" :key="index">
                    <td>
                        <div class="flex items-center space-x-1">
                            <div>
                                <span class="font-bold">#{{ task.id }}</span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <Link :href="`/projects/1/tasks/${task.id}`">
                            <div class="flex items-center space-x-1 hover:underline">
                                <div>
                                    <span>{{ task.title }}</span>
                                </div>
                            </div>
                        </Link>
                    </td>
                    <td>
                        <span :class="getClass(translateStatus[task.status.toLowerCase()])"
                              class="badge badge-ghost badge-sm">{{ translateStatus[task.status.toLowerCase()] }}</span>
                    </td>
                    <td>
                        <div class="flex items-center space-x-1">
                            <div>
                                <span class="font-bold">{{ task.score }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-2 flex space-x-3">
                        <div>
                            <label class="btn btn-square btn-circle" for="task-edition">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </label>
                        </div>
                        <Link :href="`/tasks/${task.id}`" as="button" class="btn btn-square btn-circle" method="delete"
                              preserve-scroll type="button">
                            <svg height="18px" viewBox="0 0 18 18" width="18px" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 18H5a2 2 0 0 1-2-2V7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v9a2 2 0 0 1-2 2zm3-15a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3a1 1 0 0 1 1 1z"
                                    fill="#FFFFFF"/>
                            </svg>
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <input id="my-modal" class="modal-toggle" type="checkbox"/>
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Créer une tâche</h3>
                <form @submit.prevent="form.post('/tasks', {
                        preserveScroll: true,
                        onSuccess: () => {
                            form.reset()
                            closeModal()
                        },
                })">
                    <div class="flex flex-col">
                        <label class="py-4">Nom de la tâche</label>
                        <input v-model="form.title" class="input input-bordered input-primary w-full max-w-xs"
                               type="text"/>
                        <div class="text-error" v-if="form.errors.title">{{ form.errors.title }}</div>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Description</label>
                        <input v-model="form.description" class="input input-bordered input-primary w-full max-w-xs"
                               type="text"/>
                        <div class="text-error" v-if="form.errors.description">{{ form.errors.description }}</div>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Priorité</label>
                        <input v-model="form.score" class="input input-bordered input-primary w-full max-w-xs"
                               max="3" min="0" type="number"/>
                        <div class="text-error" v-if="form.errors.score">{{ form.errors.score }}</div>
                    </div>

                    <div class="modal-action">
                        <button :disabled="form.processing" class="btn" type="submit">
                            créer
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <input id="task-edition" class="modal-toggle" type="checkbox"/>
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Modifier la tâche</h3>
                <form @submit.prevent="form.put('/tasks/' + task)">
                    <div class="flex flex-col">
                        <label class="py-4">Nom de la tâche</label>
                        <input v-model="form.title" class="input input-bordered input-primary w-full max-w-xs"
                               type="text"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Description</label>
                        <input v-model="form.description" class="input input-bordered input-primary w-full max-w-xs"
                               type="text"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Priorité</label>
                        <input v-model="form.score"
                               class="input input-bordered input-primary w-full max-w-xs"
                               max="3" min="0" type="number"/>
                    </div>

                    <div class="modal-action">
                        <button :disabled="form.processing" type="submit">
                            <label class="btn" for="task-edition">Créer</label>
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </AppLayout>
</template>
