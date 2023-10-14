<template>
    <div class="min-h-full">
    <nav-bar/>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script setup>
import NavBar from "@/components/navBar.vue";
</script>