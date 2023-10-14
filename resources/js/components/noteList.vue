<template>
    <div class="lg:flex lg:items-center lg:justify-between p-6 border border-gray-200 rounded-lg shadow mt-4">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{note.tittle}}</h2>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <template v-if="note.tasks.length === 0">
                    No tasks
                </template>
                <div v-else class="mt-2 flex items-center text-sm text-gray-500" v-for="task in note.tasks">
                    <task :task="task"></task>
                </div>
            </div>
        </div>
        <div class="mt-5 flex lg:ml-4 lg:mt-0">
        <span class="hidden sm:block">
            <Link :href="route('notes.edit', {note: note.id})" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
              <PencilIcon class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
              Edit
            </Link>
        </span>

        <span class="sm:ml-3">
            <button @click="confirmDeleteModel" type="button" class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
              <XCircleIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
              delete
            </button>
        </span>
        </div>
    </div>
    <modal :open="showConfirmDeleteModel" :route-name="'notes.destroy'" :id="note.id" :name="'note'"></modal>
</template>

<script setup>
import {
    XCircleIcon,
    PencilIcon,
} from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3'
import Task from "@/components/task.vue";
import Modal from "@/components/modal.vue";
import {ref} from 'vue'
import route from "ziggy-js";

const showConfirmDeleteModel = ref(false)

const confirmDeleteModel = () => {
    showConfirmDeleteModel.value = !showConfirmDeleteModel.value
}

defineProps(['note'])
</script>