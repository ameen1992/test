<template>
    <template v-for="note in notes.data">
        <note-list :note="note"></note-list>
    </template>
<!--    <pagination></pagination>-->
</template>
<script setup>
import NoteList from "@/components/noteList.vue";
import Pagination from "@/components/pagination.vue";
defineProps(['notes'])
</script>