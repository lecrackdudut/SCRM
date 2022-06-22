<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";

const props = defineProps({
    project: Object,
    task: Object,
    majRelative: String
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

let formEdition = useForm({
    title: null,
    description: null,
    status: "open",
    score: null,
    projectId: props.projectId,
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

function closeModalEdit() {
    editionModal.value.checked = false;
}

function onModify() {
    console.log(props.task);
    formEdition.title = props.task.title;
    formEdition.description = props.task.description;
    formEdition.status = props.task.status;
    formEdition.score = props.task.score;
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tâche
            </h2>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li><Link href="/">Accueil</Link></li>
                        <li><Link href="/projects">Projets</Link></li>
                        <li><Link :href="`/projects/${project.id}`">{{ project.name }}</Link></li>
                        <li>{{ task.title }}</li>
                    </ul>
                </div>
                <div class="drawer drawer-mobile">
                    <input
                        id="my-drawer-2"
                        type="checkbox"
                        class="drawer-toggle"
                    />
                    <div class="drawer-content flex flex-col lg:flex-row">
                        <div class="py-6 grow">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="flex gap-5 justify-start">
                                    <h1 class="text-2xl font-bold">#{{task.id}}</h1>
                                    <h1 class="text-2xl grow">{{task.title}}</h1>
                                    <label
                                        class="btn btn-square btn-circle"
                                        for="task-edition"
                                        @click="onModify"
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
                                <div class="flex gap-4 align-center m-2">
                                    <div>
                                        <span
                                        :class="
                                            getClass(
                                                translateStatus[
                                                    task.status.toLowerCase()
                                                ]
                                            )
                                        " class="badge badge-ghost badge-sm items-center">
                                         {{translateStatus[task.status.toLowerCase()]}}
                                        </span>
                                        Créé {{majRelative}} par
                                        <b>{{ task.author.name }}</b>
                                    </div>
                                </div>
                                <div
                                    class="overflow-x-auto w-full mt-5 bg-white rounded p-4"
                                >
                                    {{task.description}}
                                </div>
                            </div>
                        </div>
                        <div class="m-3 lg:w-1/4 flex flex-col gap-6">
                            <!-- <div>
                                <div class="flex items-center">
                                    <span class="grow">Assignees</span>
                                    <button
                                        class="btn btn-square btn-outline btn-sm"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <div class="divider m-0"></div>
                                <div class="flex flex-wrap gap-1">
                                    <div class="badge badge-lg">987,654</div>
                                </div>
                            </div> -->

                            <div>
                                <div class="flex items-center">
                                    <span class="grow mr-2">Priorité</span>
                                    <!-- <button
                                        class="btn btn-square btn-outline btn-sm"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>
                                    </button> -->
                                </div>
                                <div class="divider m-0"></div>
                                <span
                                    :class="
                                            getClassScore(
                                                task.score
                                            )
                                        "
                                    class="badge badge-ghost badge-sm">{{
                                        translateScore[task.score]
                                    }}</span>
                            </div>
                        </div>
                        <label
                            for="my-drawer-2"
                            class="btn btn-primary drawer-button lg:hidden"
                            >Open drawer</label
                        >
                    </div>
                </div>
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
                        formEdition.put('/tasks/' + task.id, {
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
