<script setup>
import {Link, useForm} from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import {ref} from "vue";
const props = defineProps({
    projects: Array,
});

const form = useForm({
    name: null,
    description: null,
});

const createModal = ref(null);
function closeModal() {
    createModal.value.checked = false;
}
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
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li><Link href="/">Accueil</Link></li>
                        <li><Link href="/projects">Projets</Link></li>
                    </ul>
                </div>
                <div class="flex justify-end">
                    <div>
                        <label
                            for="my-modal"
                            class="btn btn-primary modal-button"
                            >Créer un projet</label
                        >
                    </div>
                </div>
                <div class="overflow-x-auto w-full mt-5">
                    <table class="table w-full">
                        <!-- head -->
                        <tbody>
                            <!-- row 1 -->
                            <tr v-for="project in projects" :key="project.id">
                                <td>
                                    <Link
                                        :href="`/projects/${project.id}`"
                                        class="hover:underline"
                                    >
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <div class="avatar">
                                                <div
                                                    class="mask mask-squircle w-12 h-12"
                                                >
                                                    <img
                                                        :src="`https://ui-avatars.com/api/?name=${project.name}`"
                                                        alt="Avatar Tailwind CSS Component"
                                                    />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">
                                                    {{ project.name }}
                                                </div>
                                                <div class="text-sm opacity-50">
                                                    {{ project.author}}
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </td>

                                <td>
                                    {{ project.nbTasks }} <b>Taches</b> <br />{{
                                        project.nbSprints
                                    }}
                                    <b>Sprints</b>
                                </td>
                                <td>
                                    <Link
                                        :href="`/projects/${project.id}/members`"
                                        class="hover:underline"
                                    >
                                       {{ project.nbMembres }} Membres
                                    </Link>
                                </td>
                                <td class="text-right">
                                    Mis à jour <b>{{ project.majRelative }}</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                    <input id="my-modal" ref="createModal" class="modal-toggle" type="checkbox" />
                    <div class="modal">
                        <div class="modal-box">
                            <div class="flex justify-between">
                                <h3 class="font-bold text-lg">Créer un projet</h3>
                                <button @click="closeModal()">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"/></svg>
                                </button>
                            </div>
                            <form
                                @submit.prevent="
                        form.post('/projects', {
                            preserveScroll: true,
                            onSuccess: () => {
                                form.reset();
                                closeModal();
                            },
                        })
                    "
                            >
                                <div class="flex flex-col">
                                    <label class="py-4">Nom du projet</label>
                                    <input
                                        v-model="form.name"
                                        class="input input-bordered input-primary w-full max-w-xs"
                                        type="text"
                                    />
                                    <div class="text-error" v-if="form.errors.name">
                                        {{ form.errors.name }}
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

                                <p class="py-4">Membres</p>
                                <input
                                    type="text"
                                    class="input input-bordered input-primary w-full max-w-xs"
                                    disabled
                                />
                                <p class="py-4">Documents</p>
                                <input
                                    type="text"
                                    class="input input-bordered input-primary w-full max-w-xs"
                                    disabled
                                />

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
                    </div>
                </div>
<!--                    <input type="checkbox" id="my-modal" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Créer un projet</h3>
                            <p class="py-4">Nom du projet</p>
                            <input
                                type="text"
                                class="input input-bordered input-primary w-full max-w-xs"
                            />
                            <p class="py-4">Description</p>
                            <input
                                type="text"
                                class="input input-bordered input-primary w-full max-w-xs"
                            />
                            <p class="py-4">Membres</p>
                            <input
                                type="text"
                                class="input input-bordered input-primary w-full max-w-xs"
                                disabled
                            />
                            <p class="py-4">Documents</p>
                            <input
                                type="text"
                                class="input input-bordered input-primary w-full max-w-xs"
                                disabled
                            />

                            <div class="modal-action">
                                <label for="my-modal" class="btn">Créer</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </AppLayout>
</template>
