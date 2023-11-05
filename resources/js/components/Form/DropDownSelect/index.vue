<template>
    <div class="holiday-input mb-3">
        <label :for="label" class="mb-1">{{ label }}</label> <br>
        <select
            :id="label"
            class="w-100 px-3 py-2 border-primary border-1 rounded-2 bg-white"
            v-model="selectedValue"
            @change="$emit('update:modelValue', selectedValue)"
            autocomplete="on"
        >
            <option value="" selected>Select {{ label }}</option>
            <option v-for="(opt, y) in options" :value="getOptionValueKey(opt)" :key="y">{{
                    getOptionDisplayKey(opt)
                }}
            </option>
        </select>
        <small v-if="error" class="text-danger"><i>{{ error }}</i></small>
    </div>
</template>
<script setup>
import {ref} from "vue";

const {modelValue, options, error, label, displayKey, valueKey} = defineProps([
    'modelValue',
    'options',
    'error',
    'label',
    'displayKey',
    'valueKey'
]);
const selectedValue = ref(modelValue);

const getOptionDisplayKey = (option) => {
    return option[displayKey]
}

const getOptionValueKey = (option) => {
    return option[valueKey]
}

</script>
