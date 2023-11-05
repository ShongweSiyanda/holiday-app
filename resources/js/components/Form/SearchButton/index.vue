<script setup>
const {label, disabled} = defineProps(['label', 'disabled'])
</script>
<template>
    <button class="btn w-100 btn-primary mt-1" :disabled="disabled">{{ label }}</button>
</template>
