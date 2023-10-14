<template>
    <div @click="taskUpdate(task.id)">
        <CheckCircleIcon :class="task.status == 1 ? 'text-green-400' : 'text-gray-400'" class="mr-1.5 h-5 w-5 flex-shrink-0" aria-hidden="true" />
        {{ task.name }}
    </div>
</template>

<script setup>
import {CheckCircleIcon} from "@heroicons/vue/20/solid";
import { router } from '@inertiajs/vue3'
defineProps(['task'])

function taskUpdate(taskId) {
    router.post('/change-task-status', { "taskId": taskId })
}
</script>