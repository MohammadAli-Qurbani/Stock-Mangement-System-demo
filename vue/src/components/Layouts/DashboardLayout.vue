<script setup>
import TheHeader from '@/components/TheHeader.vue';
import TheSideBar from '@/components/includes/TheSideBar.vue';
</script>

<template>
    <TheHeader />
    <TheSideBar />


    <router-view ></router-view>
</template>
