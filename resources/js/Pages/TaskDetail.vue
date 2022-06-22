<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    project: Object,
    task: Object
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tâche
            </h2>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 table">
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
                                    <h1 class="text-2xl font-bold">#3</h1>
                                    <h1 class="text-2xl grow">Update Doc</h1>
                                    <button class="btn btn-square btn-circle">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex gap-4 align-center m-2">
                                    <div class="badge">neutral</div>
                                    <div>
                                        Créé il y a 3 ans par
                                        <b>Elwalid Kadura</b>
                                    </div>
                                </div>
                                <div
                                    class="overflow-x-auto w-full mt-5 bg-white rounded p-4"
                                >
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Morbi ut orci aliquet,
                                    malesuada tellus sit amet, sollicitudin ex.
                                    Curabitur eu leo id urna placerat viverra
                                    vel in ante. Vestibulum quam est, porta ut
                                    ullamcorper ut, blandit ut arcu. Nullam
                                    cursus ornare sem eu sollicitudin. Proin
                                    pharetra elit rutrum mi mattis, non commodo
                                    lacus sagittis. Etiam vulputate velit ex, et
                                    aliquet eros scelerisque in. Fusce lacinia
                                    justo tincidunt dapibus placerat.
                                    <br /><br />
                                    Curabitur bibendum nisl nunc, sed auctor
                                    ante pulvinar fringilla. Cras at ex lacinia,
                                    dictum arcu vitae, viverra urna. Duis
                                    commodo placerat tincidunt. Fusce eu justo
                                    eu leo consequat hendrerit. Proin non dolor
                                    vel dolor feugiat ullamcorper. Sed accumsan
                                    est eget iaculis vulputate. Nulla facilisi.
                                    <br /><br />
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Fusce diam lacus, ultricies
                                    eu nibh vitae, tristique vehicula erat.
                                    Praesent vitae mi id enim fringilla lobortis
                                    eu nec dolor. Proin finibus blandit
                                    hendrerit. Duis ultricies ac nunc ut
                                    commodo. Aenean at sapien ligula. Duis
                                    bibendum urna id libero iaculis, non
                                    vehicula mi mattis. Ut vehicula placerat
                                    erat quis blandit. Phasellus feugiat
                                    dignissim purus at efficitur. In blandit
                                    gravida tempor. Praesent consectetur ut
                                    felis id venenatis. Curabitur fringilla
                                    rhoncus viverra. Duis cursus, enim eu luctus
                                    tempus, enim urna tempor felis, auctor
                                    maximus ipsum dolor at magna. Morbi id
                                    facilisis felis, quis ullamcorper elit. Nunc
                                    venenatis ullamcorper sem, in bibendum
                                    lectus feugiat at. Proin in cursus nunc.
                                </div>
                            </div>
                        </div>
                        <div class="m-3 lg:w-1/4 flex flex-col gap-6">
                            <div>
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
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <span class="grow">Poids</span>
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
                                <div class="flex">6</div>
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
    </AppLayout>
</template>
