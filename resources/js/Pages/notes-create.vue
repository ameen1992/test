<template>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                Tittle
            </label>
            <input v-model="form.tittle" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="test" placeholder="Name of the note">
            <p v-if="form.errors.tittle" class="text-red-500 text-xs italic">{{form.errors.tittle}}</p>
        </div>
    </div>

    <div class="w-full px-3">
        <h2>Tasks</h2>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <input v-model="newTask" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Add new task">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <input type="radio" value="0" v-model="newTaskStatus" />
            <label class="p-3"  for="one">Todo</label>

            <input type="radio" value="1" v-model="newTaskStatus" />
            <label class="p-3"  for="two">Done</label>
            <button @click="addTask" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Add</button>
        </div>
        <template v-for="(task, index) in form.tasks">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <input v-model="form.tasks[index].name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <input type="radio" value="0" v-model="form.tasks[index].status" />
                <label class="p-3" for="one">Todo</label>

                <input type="radio" value="1" v-model="form.tasks[index].status" />
                <label class="p-3" for="two">Done</label>
                <button @click="deleteTask" class="mt-3 inline-flex w-full bg-red-300 justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500 sm:mt-0 sm:w-auto">Delete</button>
            </div>
            <modal :open="showConfirmDeleteModel" :route-name="'tasks.destroy'" :id="task.id" :name="'task'"></modal>
        </template>
    </div>

    <div class="w-full px-3">
        <button class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" type="submit" :disabled="form.processing" @click="saveForm">Save</button>
    </div>
</template>
<script setup>
    import route from "ziggy-js";
    import { useForm } from '@inertiajs/vue3'
    import {ref} from "vue";
    import Modal from "@/components/modal.vue";

    const props = defineProps({
        isEdit: {
            type: Boolean,
            default: false
        },
        note: {
            type: Object,
            default: () => ({}),
        },
    })

    const showConfirmDeleteModel = ref(false);
    const newTask = ref('')
    const newTaskStatus = ref(false)
    const addTask = () => {
        form.tasks.push({
            'name': newTask.value,
            'status': newTaskStatus.value,
        })

        newTask.value = null
        newTaskStatus.value = false
    }

    const form = useForm({
        tittle: props.isEdit ? props.note.tittle : null,
        tasks: props.isEdit ? props.note.tasks : [],
    })

    function saveForm() {
        if (props.isEdit) {
            form.put(route('notes.update', props.note.id))
        } else {
            form.post(route('notes.store'))
        }
    }

    function deleteTask() {
        showConfirmDeleteModel.value = !showConfirmDeleteModel.value
    }
</script>