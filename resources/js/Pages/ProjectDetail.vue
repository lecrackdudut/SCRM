<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

import { Inertia } from "@inertiajs/inertia";
import { getCurrentInstance, defineComponent } from "vue";

const props = defineProps({
    name: String,
    tasks: Array,
    project: Object,
});

const translateStatus = {
    in_progress: "En cours",
    open: "Ouverte",
    closed: "Fermée",
};
const translateScore = {
    "3": "Critique",
    "2": "Haute",
    "1": "Moyenne",
    "0": "Basse",
};

let clickedTask = ref(null);

const form = useForm({
    title: null,
    description: null,
    status: "open",
    score: null,
    projectId: props.project.id,
});

let formEdition = useForm({
    title: null,
    description: null,
    status: "open",
    score: null,
    projectId: props.project.id,
});

function getColor(status) {
    let color = "blue";
    if (status === "Ouverte") color = "green";
    if (status === "Fermée") color = "red";
    return color;
}

function getClass(status) {
    let color = getColor(status);
    let dynamicClass = "bg-orange-200";
    if (color === "green") dynamicClass = "bg-green-200";
    else if (color === "red") dynamicClass = "bg-red-200";
    return dynamicClass;
}

function getClassScore(score) {
    let dynamicClass = "bg-green-200";
    if (score == "0") dynamicClass = "bg-green-200";
    else if (score == "1") dynamicClass = "bg-yellow-200";
    else if (score == "2") dynamicClass = "bg-orange-200";
    else if (score == "3") dynamicClass = "bg-red-200";
    return dynamicClass
}
const editionModal = ref(null);
const createModal = ref(null);
function closeModal() {
    createModal.value.checked = false;
}

function closeModalEdit() {
    editionModal.value.checked = false;
}

function onModify(task) {
    clickedTask.value = task;
    formEdition.title = task.title;
    formEdition.description = task.description;
    formEdition.status = task.status;
    formEdition.score = task.score;
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Backlog
            </h2>
            <div v-if="project.description" class="text-sm text-gray-600 mt-2">
                {{ project.description }}
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li><Link href="/">Accueil</Link></li>
                        <li><Link href="/projects">Projets</Link></li>
                        <li><a>{{ name }}</a></li>
                    </ul>
                </div>
                <div class="px-4">
                    <div class="flex justify-end py-3">
                        <div>
                            <label
                                class="btn btn-primary modal-button"
                                for="my-modal"
                                >Créer une tâche</label
                            >
                        </div>
                    </div>
                    <table class="table w-full mt-2 px-3">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nom</th>
                                <th>statut</th>
                                <th>priorité</th>
                            </tr>
                        </thead>
                        <!-- head -->
                        <tbody>
                            <!-- row 2 -->
                            <tr v-for="(task, index) in tasks" :key="index">
                                <td>
                                    <div class="flex items-center space-x-1">
                                        <div>
                                            <span class="font-bold"
                                                >#{{ task.id }}</span
                                            >
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <Link
                                        :href="`/tasks/${task.id}`"
                                    >
                                        <div
                                            class="flex items-center space-x-1 hover:underline min-w-[350px]"
                                        >
                                            <div>
                                                <span>{{ task.title }}</span>
                                            </div>
                                        </div>
                                    </Link>
                                </td>
                                <td>
                                    <span
                                        :class="
                                            getClass(
                                                translateStatus[
                                                    task.status.toLowerCase()
                                                ]
                                            )
                                        "
                                        class="badge badge-ghost badge-sm"
                                        >{{
                                            translateStatus[
                                                task.status.toLowerCase()
                                            ]
                                        }}</span
                                    >
                                </td>
                                <td>
                                     <span
                                         :class="
                                            getClassScore(
                                                task.score
                                            )
                                        "
                                         class="badge badge-ghost badge-sm">{{
                                             translateScore[task.score]
                                         }}</span>
                                </td>
                                <td class="p-2 flex space-x-3">
                                    <div>
                                        <label
                                            class="btn btn-square btn-circle"
                                            for="task-edition"
                                            @click="onModify(task)"
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </label>
                                    </div>
                                    <Link
                                        :href="`/tasks/${task.id}`"
                                        as="button"
                                        class="btn btn-square btn-circle"
                                        method="delete"
                                        preserve-scroll
                                        type="button"
                                    >
                                        <svg
                                            height="18px"
                                            viewBox="0 0 18 18"
                                            width="18px"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13 18H5a2 2 0 0 1-2-2V7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v9a2 2 0 0 1-2 2zm3-15a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3a1 1 0 0 1 1 1z"
                                                fill="#FFFFFF"
                                            />
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input id="my-modal" ref="createModal" class="modal-toggle" type="checkbox" />
        <div class="modal">
            <div class="modal-box">
                <div class="flex justify-between">
                    <h3 class="font-bold text-lg">Créer une tâche</h3>
                    <button @click="closeModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"/></svg>
                    </button>
                </div>
                <form
                    @submit.prevent="
                        form.post('/tasks', {
                            preserveScroll: true,
                            onSuccess: () => {
                                form.reset();
                                closeModal();
                            },
                        })
                    "
                >
                    <div class="flex flex-col">
                        <label class="py-4">Nom de la tâche</label>
                        <input
                            v-model="form.title"
                            class="input input-bordered input-primary w-full max-w-xs"
                            type="text"
                        />
                        <div class="text-error" v-if="form.errors.title">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Description</label>
                        <input
                            v-model="form.description"
                            class="input input-bordered input-primary w-full max-w-xs"
                            type="text"
                        />
                        <div class="text-error" v-if="form.errors.description">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Priorité</label>
                        <select
                            v-model="form.score"
                            class="input input-bordered input-primary w-full max-w-xs"
                        >
                            <option value="3">Critique</option>
                            <option value="2">Haute</option>
                            <option value="1">Moyenne</option>
                            <option value="0">Basse</option>
                        </select>
                        <div class="text-error" v-if="form.errors.score">
                            {{ form.errors.score }}
                        </div>
                    </div>

                    <div class="modal-action">
                        <button
                            :disabled="form.processing"
                            class="btn"
                            type="submit"
                        >
                            créer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <input id="task-edition" ref="editionModal" class="modal-toggle" type="checkbox" />
        <div class="modal">
            <div class="modal-box">
                <div class="flex justify-between">
                    <h3 class="font-bold text-lg">Modifier la tâche</h3>
                    <button @click="closeModalEdit()">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"/></svg>
                    </button>
                </div>
                <form @submit.prevent="
                        formEdition.put('/tasks/' + clickedTask.id, {
                            preserveScroll: true,
                            onSuccess: () => {
                                formEdition.reset();
                                closeModalEdit();
                            },
                        })">
                    <div class="flex flex-col">
                        <label class="py-4">Nom de la tâche</label>
                        <input
                            v-model="formEdition.title"
                            class="input input-bordered input-primary w-full max-w-xs"
                            type="text"
                        />
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Description</label>
                        <input
                            v-model="formEdition.description"
                            class="input input-bordered input-primary w-full max-w-xs"
                            type="text"
                        />
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Status</label>
                        <select
                            v-model="formEdition.status"
                            class="input input-bordered input-primary w-full max-w-xs"
                        >
                            <option value="closed">Fermée</option>
                            <option value="open">Ouverte</option>
                            <option value="in_progress">En cours</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="py-4">Priorité</label>
                        <select
                            v-model="formEdition.score"
                            class="input input-bordered input-primary w-full max-w-xs"
                        >
                            <option value="3">Critique</option>
                            <option value="2">Haute</option>
                            <option value="1">Moyenne</option>
                            <option value="0">Basse</option>
                        </select>
                    </div>
                    <div class="modal-action">
                        <button
                            :disabled="formEdition.processing"
                            class="btn"
                            type="submit"
                        >
                            modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
