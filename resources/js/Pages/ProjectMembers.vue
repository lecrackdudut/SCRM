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
    users: Array,
    roles: Array,
});

const translateStatus = {
    scrum_master: "Scrum Master",
    product_owner: "Product Owner",
    developer: "Developer",
    admin: "Admin",
};

const form = useForm({
    user: null,
    role: null
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
    return dynamicClass;
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Membres
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
                        <li>
                            Membres
                        </li>
                    </ul>
                </div>
                <div class="px-4">
                    <table class="table w-full mt-2 px-3">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nom</th>
                                <th>Role</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <!-- head -->
                        <tbody>
                            <!-- row 2 -->
                            <tr
                                v-for="(
                                    membership, index
                                ) in project.memberships"
                                :key="index"
                            >
                                <td>
                                    <div class="flex items-center space-x-1">
                                        <div>
                                            <span class="font-bold"
                                                >#{{ membership.id }}</span
                                            >
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="flex items-center space-x-1 min-w-[350px]"
                                    >
                                        <div>
                                            <span>{{
                                                membership.user.name
                                            }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        :class="
                                            getClass(
                                                translateStatus[
                                                    membership.role.toLowerCase()
                                                ]
                                            )
                                        "
                                        class="badge badge-ghost badge-sm"
                                        >{{
                                            translateStatus[
                                                membership.role.toLowerCase()
                                            ]
                                        }}</span
                                    >
                                </td>
                                <td class="p-2 flex space-x-3">

                                    <Link
                                        :href="`/projects/${project.id}/members/${membership.id}`"
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
                            <tr></tr>
                        </tbody>
                    </table>
                    <form
                        @submit.prevent="
                            form.post(`/projects/${project.id}/members`)
                        "
                    >
                        <div class="flex m-4">
                            <span class="m-4">Nouveau membre :</span>
                            <select
                                v-model="form.user"
                                class="input input-bordered input-primary w-full max-w-xs m-4"
                            >
                                <option
                                    v-for="user in users"
                                    :key="user.id"
                                    :value="user.id"
                                >
                                    {{ user.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.user">
                                {{ form.errors.user }}
                            </div>
                            <select
                                v-model="form.role"
                                class="input input-bordered input-primary w-full max-w-xs m-4"
                            >
                                <option
                                    v-for="role in roles"
                                    :key="role"
                                    :value="role"
                                >
                                    {{ translateStatus[role.toLowerCase()] }}
                                </option>
                            </select>
                            <div v-if="form.errors.role">
                                {{ form.errors.role }}
                            </div>

                            <button class=" m-4 btn" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
